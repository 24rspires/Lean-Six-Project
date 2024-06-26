
var defaults = {
    'city': '',
    'zipcode': '',
    'price_min': 0,
    'price_max': 1000000,
    'bathroom': 0,
    'bedroom': 0
};

function isDefault(key, val)
{
    var defaultValue = defaults[key];
    if (defaults.hasOwnProperty(key))
    {
        if (val == defaultValue)
        {
            return true;
        }
    }
    return false;
}

$(document).ready(function()
{
    $("#sumbit").click(function(){
        var formData = new FormData(document.getElementById("form"));
        var urlEncodedData = [];
        
        for (var pair of formData.entries()) {
            var key = pair[0];
            var val = pair[1];
    
            if (isDefault(key, val))
            {
                continue;
            }
    
            urlEncodedData.push(
                encodeURIComponent(key) + '=' + encodeURIComponent(pair[1])
            );
        }
        
        var minPrice = $("#slider-range").slider("values", 0);
        var maxPrice = $("#slider-range").slider("values", 1);
    
        if (!isDefault("price_min", minPrice))
        {
            urlEncodedData.push(encodeURIComponent("price_min")+"="+encodeURIComponent(minPrice))
        }
        if (!isDefault("price_max", maxPrice))
        {
            urlEncodedData.push(encodeURIComponent("price_max")+"="+encodeURIComponent(maxPrice))
        }

        // function getChecked(tag)
        // {
        //     var children = tag.children;
        //     for (const tag of children)
        //     {
        //         if ($(tag).attr('checked') != undefined)
        //         {
        //             return $(tag).attr('value');
        //         }
        //     }
        // }

        // var bathroomRadiosDiv = document.getElementById("bathroomRadios");
        // var bedroomRadiosDiv = document.getElementById("bedroomRadios");

        // var bathroomRadios = getChecked(bathroomRadiosDiv) || 0;
        // var bedroomRadios = getChecked(bedroomRadiosDiv) || 0;

        // if (!isDefault("bathroom", bathroomRadios))
        // {
        //     urlEncodedData.push(encodeURIComponent("bathroom")+"="+encodeURIComponent(bathroomRadios))
        // }
        
        // if (!isDefault("bedroom", bedroomRadiosDiv))
        // {
        //     urlEncodedData.push(encodeURIComponent("bedroom")+"="+encodeURIComponent(bedroomRadiosDiv))
        // }

        var urlEncodedString = urlEncodedData.join('&');
        
        window.location.href = "search.php?" + urlEncodedString;
    })
})