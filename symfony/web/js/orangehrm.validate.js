/* All jQuery custom and common validation functions need to be written here
 * please avoid highly customized validation methods
 * you can write them in orangehrm.<module_name>.js as part of refactoring
 *
 * @author sujith
 **/
jQuery.validator.addMethod("valid_date",
    function(value, element, params) {
        var hint = params[0];
        var format = params[1];
        

        if (hint == value) {
            return true;
        }
        var d = strToDate(value, format);

        return (d != false);
    }, ""
);

//this is to check for valid alpha characters only texts no numbers or symbols
$.validator.addMethod("alpha", function(value, element) {
   return this.optional(element) || /^[a-zA-Z]+$/.test(value);
});

//this is to check for orangeHRM specific date format
$.validator.addMethod("orangehrmdate", function(value, element) {

   emptyFlag   = false;
   flag        = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/.test(value);
   
   if(value == "YYYY-mm-DD" || value == "") {
      emptyFlag = true;
      flag      = true;
   } 

   if(flag && !emptyFlag) {
      dt = (value).split("-");
      dt = new Date(dt[0], dt[1], dt[2]);
      flag = false;
      if(dt != "Invalid Date") {
         flag = true;
      }
   }

   return flag;
});
