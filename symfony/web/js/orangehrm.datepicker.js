/*
 * JQuery Date picker plugin with Holidays and Days of marker
 * This function is based on Jquery
 * 
*/
function DayMarker(options){
    
    var options = {
        holidayListAjax : './getHolidayAjax',
        daysOffListAjax : './getDaysOffAjax'
    };

    var holidayList = []; // store holiday list Public method
    var daysOffList = []; // store holiday list
    var jqValidatorDateFormat = "yy-mm-dd"

    var d = new Date(); // Private date  - current date
    var currentYear = d.getFullYear();
    
    
    // privtate function
    var setHolidayList = function(){
        $.ajax({
            url: options.holidayListAjax,
            data : "year="+currentYear,
            dataType: 'json',
            success: function(hList){
                holidayList = hList;
            },
            error:function(request){
                holidayList = [];
            }
        });
    }

    var setDaysOffList = function(){
        $.ajax({
            url: options.daysOffListAjax,
            dataType: 'json',
            success: function(hList){
                daysOffList = hList;
            },
            error:function(request){
                daysOffList = [];
            }
        });
    }

    
    var markDates = function(date){

        for (i = 0; i < holidayList.length; i++) {

            if (date.getMonth() == holidayList[i][1] - 1
                && date.getDate() == holidayList[i][2]
                && date.getFullYear() == holidayList[i][0]) {
                if(holidayList[i][3]=='f'){
                    return [true, "ui-state-fullday", ""];
                }
                else{
                    return [true, "ui-state-halfday", ""];
                }
            }
            else{
                // mark repeated dates
                if(date.getFullYear() > holidayList[i][0]){

                    if(date.getMonth() == holidayList[i][1] - 1
                        && date.getDate() == holidayList[i][2] && holidayList[i][4]==1){
                        //console.log(date.getFullYear());
                        if(holidayList[i][3]=='f'){
                            return [true, "ui-state-fullday", ""];
                        }
                        else{
                            return [true, "ui-state-halfday", ""];
                        }
                    }
                }
            }

        }

        for(i=0; i< daysOffList.length; i++){
            // Sunday is known as 0 in jQuery date picker
            daysOffList[i][0] = (daysOffList[i][0] == 7)?0:daysOffList[i][0];
                    
            if (date.getDay() == daysOffList[i][0]) {
                if(daysOffList[i][1]=='w'){
                    return [true, "ui-state-daysoff-weekend", ""];
                }
                else{
                    return [true, "ui-state-daysoff-halfday", ""];
                }

            }
        }

        return [true, ""]
    }

    /*
     * Bind the element in to the j jQuery datepicker
     */
    this.bindElement = function(input, options){
        // default properties of jQuery datepicker object
        defaults = {
            dateFormat: jqValidatorDateFormat,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: [1, 1],
            showCurrentAtPos: 0,
            firstDay: 0,
            beforeShowDay: function (date){
                return markDates(date);
            }
        }

        // overide date picker default properties
        $.extend(defaults, options);

        $(input).datepicker(
            defaults
        );


    }

    /*
     * Show the jQuery datepicker
     */
    this.show = function(button){
        $(button).datepicker('show');
    }
    
   
    /*
     * get Holiday List
     *
     * @public
     *
     */
    this.getHolidayList = function(){
        return holidayList;
    }

    /*
     * get days Off List
     * @public
     */
    this.getdaysOffList = function(){
        return daysOffList;
    }

    setHolidayList();
    setDaysOffList();
    
}

// create DayMarker Object
var daymarker = new DayMarker();