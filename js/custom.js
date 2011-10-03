$(document).ready(function() { 
    $("#submit").click(function()
    {
        $form = $(this).closest('form');
        
        $('input', $form).each(function()
        {
            if ( ! $(this).val())
            {
                $(this).attr('name', '');
            }
        });

        $form.submit();

        return false;
    });

    $("#clear").click(function()
    {
        $form = $(this).closest('form');
        
        $('input', $form).val('');

        return false;
    });
    
    $("#select-formula").change(function()
    {
        selected = $("option:selected", this).val();

        $("input[name=formula]").attr('value', selected);
    });
});