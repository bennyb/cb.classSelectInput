// Wrap your stuff in this module pattern for dependency injection
(function ($, ContentBlocks) {
    // Add your custom input to the fieldTypes object as a function
    // The dom variable contains the injected field (from the template)
    // and the data variable contains field information, properties etc.
    ContentBlocks.fieldTypes.classselectinput = function(dom, data) {
        var input = {};

        input.init = function () {
            // Generate the heading dropdown based on field configuration
            var avl = data.properties.class_options || "",
                select = dom.find('.contentblocks-field-classselect select');

            avl = avl.split(',');
            $.each(avl, function(i, lvl) {
                lvl = lvl.split('=');
                var val = _('classselectinput.' + lvl[1]) || lvl[1];
                select.append('<option value="' + lvl[0] + '">' + val + '</option>');
            });


            if (data.value) {
                select.val(data.value);
            }
            else {
                var def = data.properties.default_class || 'None';
                select.val(def);
            }

        };

        input.getData = function () {
            return {
                value: dom.find('.contentblocks-field-classselect select').val()
            };
        };

        input.confirmBeforeDelete = function() {
            var inputData = input.getData(),
            hasClass = inputData.value != data.properties.default_class
            return hasClass;
        };

        return input;
    }
})(vcJquery, ContentBlocks);