

$('.property-container').click(function()
{
    var propertyId = $(this).attr('pid');
    var target = event.target;
    if (propertyId && $(target).attr('click-ignore') === undefined)
    {
        $(".modal-body").find("iframe").attr("src", "property.php?id=" + propertyId);
        $("#staticBackdrop").modal("show");
    }
})