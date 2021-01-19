<!--
see http://antenna.io/demo/jquery-bar-rating/examples/
and https://github.com/antennaio/jquery-bar-rating
 -->
<script src="include/jquery.barrating.min.js"></script>
<!-- ---------------------------------------------------------------------------- -->
<script>
// On document load populate cities dropdown
$('document').ready(function(){
    populateCities($('#country_id').val());
});
//-----------------------------------------------------------------------------------
// function to populate cities dropdown, depending on the selected country.
// country_id is passed here as an argument and then passed to get_cities.php with GET method.
// AJAX is used to avoid reloading of customer_search.php
function populateCities(country_id) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("city").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "include/ajax_get_cities.php?country_id="+country_id, true);
    xhttp.send();
    //$("#city").selectmenu();
}
//-----------------------------------------------------------------------------------
// JQuery function for datepickers
// See https://jqueryui.com/datepicker/#date-range
// and http://api.jqueryui.com/datepicker/
$( function() {
    var dateFormat = "d-m-yy",
    from = $( "#from_date" )
        .datepicker({
            dateFormat: "d-m-yy",
            defaultDate: "+1d",
            changeMonth: true,
            numberOfMonths: 1,
            minDate: 0
        })
        .on( "change", function() {
            to.datepicker( "option", "minDate", getDate( this ) );
        }),
    to = $( "#to_date" ).datepicker({
        dateFormat: "d-m-yy",
        defaultDate: "+1d",
        changeMonth: true,
        numberOfMonths: 1
        })
        .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
        });

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }
} );




//-----------------------------------------------------------------------------------
// function for selecting minimum hotel stars
// see http://antenna.io/demo/jquery-bar-rating/examples/
// and https://github.com/antennaio/jquery-bar-rating
$(function() {
    $('#hotel_stars').barrating({
        theme: 'fontawesome-stars',
        showSelectedRating: false,
        allowEmpty: true,
        deselectable: true
    });
});
//-----------------------------------------------------------------------------------
function decrease(number_id) {
    var number = document.getElementById(number_id).innerHTML;
    if (number > 0) {
        number--;
        document.getElementById(number_id).innerHTML = number;
    }
}
//-----------------------------------------------------------------------------------
function increase(number_id) {
    var number = document.getElementById(number_id).innerHTML;
    number++;
    document.getElementById(number_id).innerHTML = number;
}
//-----------------------------------------------------------------------------------
// see https://jqueryui.com/slider/#custom-handle
// and http://api.jqueryui.com/slider/#method-values
// and https://stackoverflow.com/questions/5800714/jquery-slider-with-value-on-drag-handle-slider
// and https://stackoverflow.com/questions/2833396/jquery-ui-slider-setting-programmatically
//
// function for the 1-bed price range slider
$( function() {
    $( "#1b_range_slider" ).slider({
        range: true,
        min: 0,
        max: 300,
        values: [ 50, 150 ],
        step: 10,
        change: function( event, ui ) {
            $(ui.handle).text(ui.value+'€');
        },
        slide: function( event, ui ) {
            $(ui.handle).text(ui.value+'€');
        }
    });
    $("#1b_range_slider").slider('values',0,50); // sets first handle (index 0)
    $("#1b_range_slider").slider('values',1,150); // sets second handle (index 1)

} );
//-----------------------------------------------------------------------------------
// function for the 2-bed price range slider
$( function() {
    $( "#2b_range_slider" ).slider({
        range: true,
        min: 0,
        max: 300,
        values: [ 50, 150 ],
        step: 10,
        change: function( event, ui ) {
            $(ui.handle).text(ui.value+'€');
        },
        slide: function( event, ui ) {
            $(ui.handle).text(ui.value+'€');
        }
    });
    $("#2b_range_slider").slider('values',0,50); // sets first handle (index 0)
    $("#2b_range_slider").slider('values',1,150); // sets second handle (index 1)

} );
//-----------------------------------------------------------------------------------
// function for selecting minimum hotel stars
// see http://antenna.io/demo/jquery-bar-rating/examples/
// and https://github.com/antennaio/jquery-bar-rating
$(function() {
    $('#hotel_rating').barrating({
        theme: 'bars-square',
        showValues: true,
        showSelectedRating: false,
        allowEmpty: true,
        deselectable: true
    });
});
//----------------------------------------------------------------------------------
// function for the extra services checkboxes
// see http://api.jqueryui.com/checkboxradio/#method-enable
// and https://jqueryui.com/checkboxradio/#no-icons
$( function() {
    $( "input[type='checkbox']" ).checkboxradio({
        icon: false
    });
} );
//----------------------------------------------------------------------------------
// Following statement is needed to prevent normal search_form submission
// so that the following function can handle the submission with Ajax.
document.getElementById("search_form").addEventListener("submit", function (e) {
        e.preventDefault();
});
// Following function handles search_form submission
function process_search_button() {
    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // results_div in customer_search.php is populated by the output of ajax_customer_search.php
            document.getElementById("results_div").innerHTML = this.responseText;
        }
    };

    // get all fields of the form
    var country_id = document.getElementById("country_id").value;
    var city = document.getElementById("city").value;
    var from_date = document.getElementById("from_date").value;
    var to_date = document.getElementById("to_date").value;
    var hotel_stars = document.getElementById("hotel_stars").value;
    var rooms_1b = document.getElementById("rooms_1b").innerHTML;
    var min_1b = $( "#1b_range_slider" ).slider( "values", 0 );
    var max_1b = $( "#1b_range_slider" ).slider( "values", 1 );
    var rooms_2b = document.getElementById("rooms_2b").innerHTML;
    var min_2b = $( "#2b_range_slider" ).slider( "values", 0 );
    var max_2b = $( "#2b_range_slider" ).slider( "values", 1 );
    var hotel_rating = document.getElementById("hotel_rating").value;
    if (document.getElementById("breakfast").checked) var breakfast = '1'; else var breakfast = '0';
    if (document.getElementById("dinner").checked) var dinner = '1'; else var dinner = '0';
    if (document.getElementById("parking").checked) var parking = '1'; else var parking = '0';

    // pass all fields to ajax_customer_search.php using GET method.
    xhttp.open("GET",
        "include/ajax_customer_search.php" +
        "?country_id="+country_id+
        "&city="+city+
        "&from_date="+from_date+
        "&to_date="+to_date+
        "&hotel_stars="+hotel_stars+
        "&rooms_1b="+rooms_1b+
        "&min_1b="+min_1b+
        "&max_1b="+max_1b+
        "&rooms_2b="+rooms_2b+
        "&min_2b="+min_2b+
        "&max_2b="+max_2b+
        "&hotel_rating="+hotel_rating+
        "&breakfast="+breakfast+
        "&dinner="+dinner+
        "&parking="+parking
        , true);
    xhttp.send();
}

</script>