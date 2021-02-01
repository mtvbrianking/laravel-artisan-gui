

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Bmatovu" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu.html">Bmatovu</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_ArtisanGui" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/ArtisanGui.html">ArtisanGui</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_ArtisanGui_Http" class="opened"><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/ArtisanGui/Http.html">Http</a></div><div class="bd"><ul><li data-name="class:Bmatovu_ArtisanGui_Http_CommandController" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/ArtisanGui/Http/CommandController.html">CommandController</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_ArtisanGui_Support" class="opened"><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/ArtisanGui/Support.html">Support</a></div><div class="bd"><ul><li data-name="class:Bmatovu_ArtisanGui_Support_Commander" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/ArtisanGui/Support/Commander.html">Commander</a></div></li></ul></div></li><li data-name="class:Bmatovu_ArtisanGui_ArtisanGuiServiceProvider" class="opened"><div style="padding-left:44px" class="hd leaf"><a href="Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html">ArtisanGuiServiceProvider</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Bmatovu.html","name":"Bmatovu","doc":"Namespace Bmatovu"},{"type":"Namespace","link":"Bmatovu/ArtisanGui.html","name":"Bmatovu\\ArtisanGui","doc":"Namespace Bmatovu\\ArtisanGui"},{"type":"Namespace","link":"Bmatovu/ArtisanGui/Http.html","name":"Bmatovu\\ArtisanGui\\Http","doc":"Namespace Bmatovu\\ArtisanGui\\Http"},{"type":"Namespace","link":"Bmatovu/ArtisanGui/Support.html","name":"Bmatovu\\ArtisanGui\\Support","doc":"Namespace Bmatovu\\ArtisanGui\\Support"},                                                        {"type":"Class","fromName":"Bmatovu\\ArtisanGui","fromLink":"Bmatovu/ArtisanGui.html","link":"Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html","name":"Bmatovu\\ArtisanGui\\ArtisanGuiServiceProvider","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\ArtisanGuiServiceProvider","fromLink":"Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html","link":"Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html#method_boot","name":"Bmatovu\\ArtisanGui\\ArtisanGuiServiceProvider::boot","doc":"Bootstrap the application services."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\ArtisanGuiServiceProvider","fromLink":"Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html","link":"Bmatovu/ArtisanGui/ArtisanGuiServiceProvider.html#method_register","name":"Bmatovu\\ArtisanGui\\ArtisanGuiServiceProvider::register","doc":"Register the application services."},
            
                                                {"type":"Class","fromName":"Bmatovu\\ArtisanGui\\Http","fromLink":"Bmatovu/ArtisanGui/Http.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html","name":"Bmatovu\\ArtisanGui\\Http\\CommandController","doc":null},
                                {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method___construct","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::__construct","doc":"Create a new controller instance."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method___invoke","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::__invoke","doc":"Get artisan commands."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method_execute","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::execute","doc":"Execute artisan command."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method_flatten","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::flatten","doc":"Flatten command parameters."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method_resolve","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::resolve","doc":"Resolve command from kernel."},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Http\\CommandController","fromLink":"Bmatovu/ArtisanGui/Http/CommandController.html","link":"Bmatovu/ArtisanGui/Http/CommandController.html#method_rules","name":"Bmatovu\\ArtisanGui\\Http\\CommandController::rules","doc":"Build command validation rules."},
            
                                                {"type":"Class","fromName":"Bmatovu\\ArtisanGui\\Support","fromLink":"Bmatovu/ArtisanGui/Support.html","link":"Bmatovu/ArtisanGui/Support/Commander.html","name":"Bmatovu\\ArtisanGui\\Support\\Commander","doc":""},
                                {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method___construct","name":"Bmatovu\\ArtisanGui\\Support\\Commander::__construct","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getKernel","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getKernel","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getNamespace","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getNamespace","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getNamespaces","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getNamespaces","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getCommands","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getCommands","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getAliases","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getAliases","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getDefinition","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getDefinition","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_extractNamespace","name":"Bmatovu\\ArtisanGui\\Support\\Commander::extractNamespace","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_sortCommands","name":"Bmatovu\\ArtisanGui\\Support\\Commander::sortCommands","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_loadNamespacesAndCommands","name":"Bmatovu\\ArtisanGui\\Support\\Commander::loadNamespacesAndCommands","doc":""},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_loadApplicationDefinition","name":"Bmatovu\\ArtisanGui\\Support\\Commander::loadApplicationDefinition","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getInputArgumentData","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getInputArgumentData","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getInputOptionData","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getInputOptionData","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getInputDefinitionData","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getInputDefinitionData","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getInputDefinitionArguments","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getInputDefinitionArguments","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getInputDefinitionOptions","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getInputDefinitionOptions","doc":null},
        {"type":"Method","fromName":"Bmatovu\\ArtisanGui\\Support\\Commander","fromLink":"Bmatovu/ArtisanGui/Support/Commander.html","link":"Bmatovu/ArtisanGui/Support/Commander.html#method_getCommandData","name":"Bmatovu\\ArtisanGui\\Support\\Commander::getCommandData","doc":null},
            
                                // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


