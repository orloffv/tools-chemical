(function($) {
    $.fn.hint = function() {
        $(this).closest('form').submit(function() 
        {
            clear_form_nametitles($(this));
        });
        
        return $(this).each(function (){
            var t = $(this);
            var title = t.attr('title');
            if (title) {
                t.blur(function (){
                    if (t.val() == '') {
                        t.val(title);
                        t.addClass('blur');
                    }
                });
                t.focus(function (){
                    if (t.val() == title){
                        t.val('');
                        t.removeClass('blur');
                    }
                });
                t.blur();
            }
        });
    }
    
    clear_form_nametitles = function($this)
    {
        $('input, textarea', $this).each(function() 
        {
            if ($(this).attr('title') && $(this).val() == $(this).attr('title'))
            {
                $(this).val('');
            }
        });
    }
})(jQuery);

$(document).ready(function() { 
    $('input[title!=""], textarea[title!=""]').hint();
    
    /*
    if (navigator.userAgent.indexOf('iPhone') != -1) 
    {
        addEventListener("load", function() 
        {
            setTimeout(hideURLbar, 0);
        }, false);
    }

    function hideURLbar() 
    {
        window.scrollTo(0, 1);
    }
    */

    $("#select-formula").change(function(){
        selected = $("option:selected", this).val();

        $("input[name=formula]").attr('value', selected);
    });
});