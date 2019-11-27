/* All js functions need to be written here
 * Module sepcific functions SHOULD be written inside module js file
 * orangehrm.<module_name>.js added as part of refactoring
 * For better clarity and optimization please use JQuery libraries
 *
 * @author sujith
 **/

/* use this function when needed to have type=button instead of reset, for resetting initial values
 **/
function resetCurrent(fields, values)
{
   fields   = ($("#" + fields).val()).split("|");
   values   = ($("#" + values).val()).split("|");

   for(i=0;i < fields.length; i++) {
      if($("#" + fields[i]).attr('type') == 'radio' || $("#" + fields[i]).attr('type') == 'checkbox') {
         if(values[i] != 'true') {
            $("#" + fields[i]).removeAttr('checked');
         } else {
            $("#" + fields[i]).attr('checked', values[i]);
         }
      } else {
         $("#" + fields[i]).val(values[i]);
      }
   }
}
