//We have form validation and other stuff..

function validatefilename ( form )
{
  // see http://www.thesitewizard.com/archive/validation.shtml
  // for an explanation of this script and how to use it on your
  // own website

  // ** START **
  if (form.the_file.value == "") {
    alert( "Please select an sql file to import" );
    form.the_file.focus();
    return false ;
  }
  // ** END **
  return true ;
}