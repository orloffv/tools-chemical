(function($) {
    $.fn.hint = function() 
    {
        $(this).closest('form').submit(function() 
        {
            clear_form_nametitles($(this), true);
        });
        
        return $(this).each(function ()
        {
            var t = $(this);
            var title = t.attr('title');
            if (title) 
            {
                t.blur(function ()
                {
                    if (t.val() == '') 
                    {
                        t.val(title);
                        t.addClass('blur');
                    }
                });
                t.focus(function ()
                {
                    if (t.val() == title)
                    {
                        t.val('');
                        t.removeClass('blur');
                    }
                });
                t.blur();
            }
        });
    }
    
    clear_form_nametitles = function($this, clear)
    {
        $('input, textarea', $this).each(function() 
        {
            if ($(this).attr('title') && $(this).val() == $(this).attr('title'))
            {
                $(this).val('');
                if (clear)
                {
                    $(this).attr('name', '');
                }
            }

            if( ! $(this).val() && clear)
            {
                $(this).attr('name', '');
            }
        });
    }
})(jQuery);

$(document).ready(function() { 
    $('input[title!=""], textarea[title!=""]').hint();

    $("#submit").click(function()
    {
        $form = $(this).closest('form');
        
        clear_form_nametitles($form, true);
        
        var data = {
            'formula' : $('input[name=formula]', $form).val(),
            'x' : $('input[name=x]', $form).val(),
            'y' : $('input[name=y]', $form).val(),
            'z' : $('input[name=z]', $form).val()
        };

        $.get('app.php?ajax', data, function(result)
        {
           $(".ajax-data").html(result);
        });

        return false;
    });
    
    $("#select-formula").change(function()
    {
        selected = $("option:selected", this).val();

        $("input[name=formula]").attr('value', selected);
    });
});