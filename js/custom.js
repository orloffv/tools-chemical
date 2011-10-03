$(document).ready(function() { 
    $("#submit").click(function()
    {
        $form = $(this).closest('form');
        
        $form.submit();

        return false;
    });
    
    $("#select-formula").change(function()
    {
        selected = $("option:selected", this).val();

        $("input[name=formula]").attr('value', selected);
    });
});