// Wrap your stuff in this module pattern for dependency injection
(function ($, ContentBlocks) {
    // Add your custom input to the fieldTypes object as a function
    // The dom variable contains the injected field (from the template)
    // and the data variable contains field information, properties etc.
    ContentBlocks.fieldTypes.selectinput = function(dom, data) {
        var input = {};

        input.init = function () {
            // Generate the heading dropdown based on field configuration
            var avl = data.properties.class_options || "",
                select = dom.find('.contentblocks-field-select select');
            
            // make a blank option at the top. though this disables the ability to make it required (in an obvious way)
            select.append('<option value=""></option>');

            avl = avl.split('\n');
            $.each(avl, function(i, lvl) {
                lvl = lvl.split('=');
                var disp = _('selectinput.' + lvl[0]) || lvl[0],
                    val  = lvl[1] || lvl[0];
                select.append('<option value="' + val + '">' + disp + '</option>');
            });


            if (data.value) {
                select.val(data.value);
            }
            else {
                var def = data.properties.default_value || '';
                select.val(def);
            }

        };

        input.getData = function () {
            var selected = dom.find('.contentblocks-field-select select option:selected'),
                value = selected.val(),
                display = selected.text();
                
            return {
                value: value,
                display: display                
            };
        };

        input.confirmBeforeDelete = function() {
            var inputData = input.getData(),
            hasClass = inputData.value != data.properties.default_value
            return hasClass;
        };

        return input;
    }
})(vcJquery, ContentBlocks);