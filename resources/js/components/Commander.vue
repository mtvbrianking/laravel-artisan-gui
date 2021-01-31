<template>
    <div class="commander row">
        <div class="col-lg-3 col-md-4 col-sm-5">
            <div class="card">
                <div class="card-body">
                    <h4>Commands</h4>
                    <input type="text" v-model="search" class="form-control" placeholder="Search...">
                    <hr/>
                    <ul class="namespaces">
                        <li class="namespace"
                            v-for="(commands, namespace) in filteredCommands"
                            v-bind:key="namespace">
                            {{ namespace }}
                            <ul class="commands">
                                <li class="command"
                                    v-for="(commandName, idx) in commands"
                                    v-bind:key="idx"
                                    v-on:click.prevent="select(commandName, $event)"
                                    v-bind:class="{ selected: command && (command.name == commandName) }">
                                    {{ commandName }}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="console mb-3" v-if="this.output">
                <pre class="command font-weight-bold">>_ php artisan {{ this.command.name }} {{ this.parameters }}</pre>
                <pre class="output">{{ this.output }}</pre>
            </div>
            <div class="card" v-if="this.command">
                <div class="card-body">
                    <form method="POST" @submit.prevent="onSubmit">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h3>{{ this.command.name }}</h3>
                                <small class="d-block">{{ this.command.description }}</small>
                                <!-- <code>{{ this.command.synopsis }}</code> -->
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-dark">
                                    <i class="bx bx-terminal"></i> Run
                                </button>
                            </div>
                        </div>

                        <hr>

                        <h5 v-if="hasArguments">Arguments</h5>

                        <hr v-if="hasArguments">

                        <div class="form-group row" v-for="(argument, name) in this.command.arguments" v-bind:key="name">
                            <label class="col-lg-3 col-md-4 col-form-label" v-bind:class="{ required: argument.is_required }">
                                {{ name }} <span v-if="argument.is_array">[+]</span>
                            </label>

                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control"
                                    v-if="! argument.is_array"
                                    v-model="argument.value"
                                    :required="argument.is_required"/>

                                <input type="text" class="form-control"
                                    v-if="argument.is_array"
                                    v-for="(item, index) in argument.value" :key="index"
                                    v-model="argument.value[index]" :required="argument.is_required"/>

                                <small class="form-text text-muted">{{ argument.description }}</small>
                            </div>
                        </div>

                        <h5 v-if="hasOptions">Options</h5>

                        <hr v-if="hasOptions">

                        <div class="form-group row" v-for="(option, name) in this.command.options" v-bind:key="name">
                            <label class="col-lg-3 col-md-4 col-form-label" :class="{ required: option.is_required }">
                                {{ name }} <span v-if="option.is_array">[+]</span>
                            </label>

                            <div class="col-lg-9 col-md-8" v-if="! option.is_flag">
                                <input type="text" class="form-control"
                                    v-if="! option.is_array"
                                    v-model="option.value"
                                    :required="option.is_required"/>

                                <input type="text" class="form-control"
                                    v-if="option.is_array"
                                    v-for="(item, index) in option.value" :key="index"
                                    v-model="option.value[index]" :required="option.is_required"/>

                                <small class="form-text text-muted">{{ option.description }}</small>
                            </div>

                            <div class="col-lg-9 col-md-8" v-if="option.is_flag">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" v-model="option.value" :required="option.is_required"/>
                                    <label class="form-check-label" for="">{{ option.description }}</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'commander',
        data() {
            return {
                search: '',
                command: null,
                // arguments: null,
                // options: null,
                namespaces: null,
                commands: null,
                parameters: null,
                output: null,
            }
        },
        mounted() {
            this.initArtisan();
        },
        methods: {
            initArtisan: function() {
                // route('commands')
                axios.get('/commands')
                .then((response) => {
                    this.namespaces = response.data.namespaces;
                    // this.arguments = response.data.definition.arguments;
                    // this.options = response.data.definition.options;
                    this.commands = response.data.commands;
                }, (error) => {
                    console.error(error);
                });
            },
            select: function(commandName, event) {
                // if(event.ctrlKey) { console.log('Ctrl + click'); }

                this.output = null;

                this.command = this.commands[commandName];

                // console.log(JSON.parse(JSON.stringify(this.command)));

                if(this.hasArguments) {
                    for(const name in this.command.arguments) {
                        if(this.command.arguments[name].is_array) {
                            this.command.arguments[name].value = [''];
                        }
                    }
                }

                if(this.hasOptions) {
                    for(const name in this.command.options) {
                        if(this.command.options[name].is_array) {
                            this.command.options[name].value = [''];
                        }
                    }
                }
            },
            formParams: function() {
                var params = {};

                for(const name in this.command.arguments) {
                    params[name] = this.command.arguments[name].value;
                }

                for(const name in this.command.options) {
                    if(this.command.options[name].is_flag && ! this.command.options[name].value) {
                        continue;
                    }

                    params[`--${name}`] = this.command.options[name].value;
                }

                return params;
            },
            onSubmit: function() {
                var params = this.formParams();

                // route('commands.execute', this.command.name)
                axios.post(`/commands/${this.command.name}`, params)
                .then((response) => {
                    this.output = response.data.output;
                    this.parameters = response.data.parameters;

                    // console.log(response.data);
                }, (error) => {
                    console.error(error);
                });
            }
        },
        computed: {
            hasArguments: function() {
                return this.command && Object.keys(this.command.arguments).length;
            },
            hasOptions: function() {
                return this.command && Object.keys(this.command.options).length;
            },
            filteredCommands: function() {
                let app = this;

                var matchedNs = {};

                for(const group in app.namespaces) {
                    if (! app.namespaces.hasOwnProperty(group)) { continue; }

                    var commands = app.namespaces[group];

                    var matched = commands.filter(function(commandName) {
                        return commandName.toLowerCase().indexOf(app.search.toLowerCase()) !== -1
                    });

                    if(matched.length == 0) {
                        continue;
                    }

                    matchedNs[group] = matched;
                }

                return matchedNs;
            }
        }
    }
</script>

<style scoped>
    ul.namespaces {
        height: calc(100vh - 250px);
        overflow-y: auto;
    }

    ul.namespaces > li {
        margin: 10px 0;
        /*font-weight: bold;*/
        /*text-transform: uppercase;*/
    }

    ul.commands {
        list-style: circle;
        list-style-type: "→";
        padding-left: 10px;
    }

    ul.commands > li {
        padding-left: 10px;
    }

    ul.commands > li:hover {
        cursor: pointer;
        text-decoration: underline;
    }

    ul.commands > li.selected {
        font-weight: bold;
    }

    .console {
        background: #212529;
        padding: 10px;
        border-radius: 5px;
        /*max-height: 100vh;*/
        max-height: 500px;
        overflow-y: auto;
    }

    .console pre {
        color: #eee;
    }

    .console pre.command {
        background: #46484a;
        padding: 10px;
        border-radius: 5px;
        white-space: normal;
    }
</style>
