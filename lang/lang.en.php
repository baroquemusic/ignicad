<?php

$lang = array();

// BASICS
$lang['HTML_LANG'] = 'en';
$lang['COUNTRY'] = 'International';
$lang['PAGE_TITLE'] = 'igniCAD';
$lang['SOFTWARE_NAME'] = 'igniCAD';
$lang['SOFTWARE_VERSION'] = 'Beta 5.3.7';

// ADMIN

$lang['ADMIN_LOG_IN'] = 'Admin login';
$lang['ADMIN_PAGE_TITLE'] = 'igniCAD admin page';

// HINTS

$lang['TITLE_BALANCE'] = 'Check or charge your balance'; 
$lang['TITLE_RESET_PASSWORD'] = 'Change password';
$lang['TITLE_LOGOUT'] = 'Logout';
$lang['TITLE_COMBUSTION_CHAMBER'] = 'Set the basic values and dimensions of your combustion chamber';
$lang['TITLE_FLUE_PIPES'] = 'Design your combustion chamber vent and flue pipe system ';
$lang['TITLE_MY_PROJECTS'] = 'Complete current project and manage closed projects';
$lang['TITLE_COMBUSTION_CHAMBER1'] = 'Set the general values of your stove. You may choose which two of the three parameters you wish to set; the third one is to be calculated by igniCAD';
$lang['TITLE_NOMINAL_HEATING_TIME'] = 'Enter nominal heating time of your stove. Most common values are 8hrs or 12hrs. Entering this value will affect maximum load or nominal heat output';
$lang['TITLE_NOMINAL_HEATING_TIME_RADIO'] = 'Choose this option if you wish igniCAD to calculate nominal heating time based on your input of maximum load and nominal heat output';
$lang['TITLE_MAXIMUM_LOAD_UNIT'] = 'Enter maximum load of your stove. Standard specification: 1/900 of the total inner surface of the combustion chamber. Entering this value will affect nominal heating time or nominal heat output';
$lang['TITLE_MAXIMUM_LOAD_UNIT_RADIO'] = 'Choose this option if you wish igniCAD to calculate maximum load based on your input of nominal heating time and nominal heat output';
$lang['TITLE_NOMINAL_HEAT_OUTPUT'] = 'Enter maximum load of your stove. Entering this value will affect nominal heating time or maximum load';
$lang['TITLE_NOMINAL_HEAT_OUTPUT_RADIO'] = 'Choose this option if you wish igniCAD to calculate nominal heating output based on your input of maximum load and nominal heating time';
$lang['TITLE_COMBUSTION_CHAMBER2'] = 'Set the dimensions of your combustion chamber';
$lang['TITLE_COMBUSTION_CHAMBER_SURFACE'] = 'Total inner surface of your combustion chamber. It is linked to height, width and depth values of the combustion chamber';
$lang['TITLE_COMBUSTION_CHAMBER_SURFACE_CHECKBOX'] = 'Checked OFF: setting the height, width or depth of the combustion chamber affects their relative ratio, total inner surface is left untouched. Checked ON: setting the height, width or depth of the combustion chamber sets total inner surface';
$lang['TITLE_COMBUSTION_CHAMBER_HEIGHT'] = 'Enter height of combustion chamber. Standard specification: maximum load + 25 cm';
$lang['TITLE_COMBUSTION_CHAMBER_AREA'] = 'Floor area of your combution chamber. It is linked to the width and depth of the combustion chamber';
$lang['TITLE_COMBUSTION_CHAMBER_AREA_CHECKBOX'] = 'Checked OFF: setting the width or depth of the combustion chamber affects their relative ratio, floor area is left untouched. Checked ON: setting the width or depth of the combustion chamber sets floor area';
$lang['TITLE_COMBUSTION_CHAMBER_AREA_X'] = 'Enter depth of the combustion chamber';
$lang['TITLE_COMBUSTION_CHAMBER_AREA_Y'] = 'Enter width of the combustion chamber';
$lang['TITLE_COMBUSTION_CHAMBER3'] = 'Set the surrounding parameters';
$lang['TITLE_ELEVATION'] = 'Enter geolocical altitude (unit: meter)';
$lang['TITLE_AIR_TEMPERATURE'] = 'Enter surrounding temperature (unit: grade Celsius)';
$lang['TITLE_SHELL'] = 'Choose stove design: Univalve (no-air-gap design) or Bivalve (air-gap design)';
$lang['TITLE_RESISTANCE_RANGE_MIN'] = 'Enter the expected minimum total drag of your stove. It is generally a function of the parameters of the chimney';
$lang['TITLE_RESISTANCE_RANGE_MAX'] = 'Enter the expected maximum total drag of your stove. It is generally a function of the parameters of the chimney';
$lang['TITLE_COMBUSTION_CHAMBER_VENT1'] = 'The combustion chamber vent is the first section of the flue pipe system. IT IS A COMPULSORY PART OF YOUR SYSTEM, YOU CANNOT DELETE IT';
$lang['TITLE_COMBUSTION_CHAMBER_VENT'] = 'Set the place of the combustion chamber vent on the combustion chamber. YOU CANNOT MODIFY IT ONCE YOU WILL HAVE APPENDED A FLUE PIPE ON IT';
$lang['TITLE_VENT_CENTER'] = 'Reset the position of the combustion chamber vent';
$lang['TITLE_VENT_WIDTH'] = 'Set the width-wise position of the combustion chamber vent';
$lang['TITLE_VENT_DEPTH'] = 'Set the depth-wise position of the combustion chamber vent';
$lang['TITLE_VENT_HEIGHT'] = 'Check the height-wise position of the combustion chamber vent. ONLY INFORMATIVE. NOT EDITABLE';
$lang['TITLE_PIPE_SECTION_X'] = 'Dimension X of pipe section';
$lang['TITLE_PIPE_SECTION_Y'] = 'Dimension Y of pipe section';
$lang['TITLE_PIPE_SECTION_Z'] = 'Length of pipe section';
$lang['TITLE_PIPE_MATIERIAL'] = 'Material of pipe section walls. Raw 4 is roughest';
$lang['TITLE_DELETE'] = 'Remove last pipe section';
$lang['TITLE_ADD_PIPE'] = 'Add new pipe section to the end of the flue pipe system';
$lang['TITLE_CURRENT_PROJECT'] = 'Magage your current editable project';
$lang['TITLE_BACK_TO_EDIT'] = 'The current project stays editable. You may not print editable your current editable project';
$lang['TITLE_CLOSE_PROJECT'] = 'Close current project. WARNING: CLOSING YOUR PROJECT PREVENTS FURTHER EDITING';
$lang['TITLE_NO_SAVED_PROJECT'] = 'You do not have closed projects yet. You may print or clone closed projects only.';
$lang['TITLE_SAVED_PROJECTS'] = 'List of closed projects. You may print or clone but not edit closed projects';
$lang['TITLE_SAVED_PROJECTS_LIST'] = 'List of closed projects. You may print or clone but not edit closed projects';
$lang['TITLE_CLONE_PROJECT'] = 'Clone the selected closed project. Cloned copy is editable, while original copy stays closed';
$lang['TITLE_INFO'] = 'Business card of the selected project';
$lang['TITLE_PRINT_PROJECT'] = 'Print the selected closed project';
$lang['TITLE_PROJECT_OPS1'] = 'Description and purpose the project';
$lang['TITLE_PROJECT_NAME'] = 'Name of the project for identification purposes';
$lang['TITLE_PURPOSE_OF_USE'] = 'Issue call. Design: new stove design. Checking: measuring of existing (already built) stove';
$lang['TITLE_PROJECT_OPS2'] = 'Business card of the builder';
$lang['TITLE_PROJECT_OPS3'] = 'Business card of the buyer';
$lang['TITLE_PROJECT_OPS4'] = 'Your current balance. You need to have a positive balance to close the project';
$lang['TITLE_CLOSE_PROJECT_BUTTON'] = 'Complete project closing';
$lang['TITLE_3D'] = 'Click and hold left mouse button for free-hand rotation. Scroll mouse wheel to zoom in and out';
$lang['TITLE_3D_RANGE'] = 'Click and pull slider for horizontal rotation';
$lang['TITLE_3D_NUMBER'] = 'Enter angle of horizontal rotation';
$lang['TITLE_PIPE_VIEW'] = 'Choose the most suitable view of the pipe system';
$lang['TITLE_CONSOLE'] = 'System messages. Green font: internet connection is available, your work is saved. Red or orange font: indicated parameters of your design do not comply with standard specifications yet';


// PRINT
$lang['PAGE_TITLE_PRINT'] = 'Stove Measuring Certificate';
$lang['PUBLISHER'] = 'Issuer';
$lang['ENTERPRISE'] = 'Builder';
$lang['CUSTOMER'] = 'Customer';
$lang['PUBLISHER_NAME'] = 'Issuer: ';
$lang['DATETIME_OF_ISSUE'] = 'Issue date and time: ';
$lang['STOVE_DATA'] = 'Stove data';
$lang['SUM_PIPE_LENGTH'] = 'Total pipe length: ';
$lang['EXIT_TEMPERATURE'] = 'Exit temperature: ';
$lang['SUM_PH'] = 'Static pressure: ';
$lang['SUM_PS'] = 'Frictional resistance: ';
$lang['SUM_PA'] = 'Formal resistance: ';
$lang['SUM_RESISTANCE'] = 'TOTAL DRAG: ';
$lang['EFFICIENCY'] = 'EFFICIENCY: ';
$lang['AIR_NEED'] = 'Air demand: ';
$lang['GAS_GROOVE'] = 'Safety burn through: ';
$lang['MAX_WOOD'] = 'Maximum load: ';
$lang['MIN_WOOD'] = 'Minimum load: ';
$lang['BURNING_RATE'] = 'Burning rate: ';
$lang['WARNING'] = 'Warning';
$lang['COMBUSTION_CHAMBER_DATA'] = 'Chamber data';
$lang['PLACE_DATA'] = 'Surroundings';
$lang['PIPE_DATA'] = 'Flue pipe data';
$lang['HEIGHT'] = 'Height:';
$lang['WIDTH'] = 'Width:';
$lang['DEPTH'] = 'Depth: ';
$lang['SECTION'] = 'Section';
$lang['LENGTH'] = 'Len.';
$lang['MATERIAL'] = 'Rough';
$lang['TEMPERATURE'] = 'Temp';
$lang['FLUE_SPEED'] = 'Speed';
$lang['FLUE_SPEED_UNIT'] = 'm/s';
$lang['SUBTITLE'] = 'Appendix of Contractor Statement recommended as per EN 15544';
$lang['LOAD'] = 'Max load: ';
$lang['POWER'] = 'Nominal output: ';
$lang['BLUEPRINT'] = '3D blueprint';
$lang['FLUE_MASS_FLOW_MAX'] = 'Max mass flow: ';
$lang['FLUE_MASS_FLOW_MIN'] = 'Min mass flow: ';
$lang['ISSUE_CALL'] = 'Issue call: ';
$lang['PRINT'] = 'Print';

// LOGGED IN TO SOFTWARE
$lang['WELCOME_IN'] = 'Welcome to igniCAD!';
//$lang['WELCOME_SUB'] = 'Our service is FREE OF CHARGE at the moment!';
$lang['WELCOME_SUB'] = '';
$lang['COMBUSTION_CHAMBER'] = 'Combustion chamber';
$lang['FLUE_PIPES'] = 'Flue pipes';
$lang['DATA_OPERATIONS'] = 'Data operations';
$lang['MY_PROJECTS'] = 'My projects';
$lang['BALANCE'] = 'My balance';
$lang['PLEASE_REFILL_BALANCE'] = 'Please recharge your balance!';

// INPUT PARAMETERS
$lang['NOMINAL_HEATING_TIME'] = 'Nominal heating time:';
$lang['NOMINAL_HEATING_TIME_UNIT'] = 'hour';
$lang['MAXIMUM_LOAD'] = 'Maximum load:';
$lang['MAXIMUM_LOAD_UNIT'] = 'kg';
$lang['NOMINAL_HEAT_OUTPUT'] = 'Nominal heat output:';
$lang['NOMINAL_HEAT_OUTPUT_UNIT'] = 'kW';
$lang['COMBUSTION_CHAMBER_SURFACE'] = 'Inner surface:';
$lang['COMBUSTION_CHAMBER_HEIGHT'] = 'Height:';
$lang['COMBUSTION_CHAMBER_AREA'] = 'Floor area:';
$lang['ELEVATION'] = 'Geodetic altitude:';
$lang['ELEVATION_UNIT'] = 'm';
$lang['RESISTANCE_RANGE'] = 'Expected drag range: ';
$lang['MIN'] = 'min.: ';
$lang['MAX'] = 'max.: ';
$lang['AIR_TEMPERATURE'] = 'Air temp.:';
$lang['AIR_TEMPERATURE_UNIT'] = '&deg;C';
$lang['CENTIMETER_UNIT'] = 'cm';
$lang['SINGLE_SHELL'] = 'Univalve';
$lang['DOUBLE_SHELL'] = 'Bivalve';
$lang['COMBUSTION_CHAMBER_VENT'] = 'Position of combustion chamber vent:';
$lang['VENT_UP'] = 'Top';
$lang['VENT_LEFT'] = 'Left';
$lang['VENT_RIGHT'] = 'Right';
$lang['VENT_BACK'] = 'Back';
$lang['VENT_LEFT-RIGHT'] = 'Sides';
$lang['VENT_CENTER'] = 'Center';
$lang['VENT_WIDTH'] = 'Width: ';
$lang['VENT_DEPTH'] = 'Depth: ';
$lang['VENT_HEIGHT'] = 'Height: ';
$lang['PIPE_SECTION'] = 'Section: ';
$lang['PIPE_LENGTH'] = 'Length: ';
$lang['PIPE_MATIERIAL_FIRECLAY_PLATE'] = 'Fireclay tube';
$lang['PIPE_MATIERIAL_FIRECLAY'] = 'Fireclay';
$lang['PIPE_MATIERIAL_STEEL'] = 'Steel tube';
$lang['PIPE_MATIERIAL_RAW1'] = 'Raw 1';
$lang['PIPE_MATIERIAL_RAW2'] = 'Raw 2';
$lang['PIPE_MATIERIAL_RAW3'] = 'Raw 3';
$lang['PIPE_MATIERIAL_RAW4'] = 'Raw 4';
$lang['DELETE'] = 'delete';
$lang['ADD_PIPE'] = '+ ADD NEW SECTION';
$lang['PROJECT_NAME'] = 'Project name: ';
$lang['PURPOSE_OF_USE'] = 'Issue call: ';
$lang['SIZING'] = 'Design';
$lang['CHECKING'] = 'Check';
$lang['YOUR_ENTERPRISE'] = 'Builder info';
$lang['ENTERPRISE_NAME'] = 'Builder name: ';
$lang['ADDRESS_STREET'] = 'Address: ';
$lang['ADDRESS_TOWN'] = 'City: ';
$lang['ADDRESS_ZIP'] = 'ZIP code: ';
$lang['ADDRESS_COUNTRY'] = 'Country: ';
$lang['ENTERPRISE_TAX_NUMBER'] = 'Tex reg.: ';
$lang['YOUR_CUSTOMER'] = 'Customer info';
$lang['CUSTOMER_FULL_NAME'] = 'Customer name: ';
$lang['CUSTOMER_PHONE_NUM'] = 'Phone number: ';
$lang['YOUR_BALANCE'] = 'Your current balance';
$lang['PROJECT_REMAINING'] = 'Projects remaining: ';
$lang['REFILL_BALANCE_WITH_CODE'] = 'Recharge your balance with coupon: ';
$lang['REFILL'] = 'Recharge';
$lang['CLOSE_PROJECT'] = 'Close project';
$lang['PRINT_PROJECT'] = 'Print project!';
$lang['SAVED_PROJECTS'] = 'My closed projects';
$lang['NO_SAVED_PROJECT'] = 'You do not have closed projects yet';
$lang['CLONE_PROJECT'] = 'Clone project';
$lang['NOT_OBLIGATORY'] = 'not obligatory';
$lang['CANCEL'] = 'Cancel';
$lang['CURRENT_PROJECT'] = 'Current project';
$lang['BACK_TO_EDIT'] = 'Back to editing';

// 3D VIEW
$lang['PIPE_TUBE'] = 'Flue pipe wall';
$lang['PIPE_CENTERLINE'] = 'Centerline';
$lang['PIPE_WIREFRAME'] = 'Wireframe';

// LOGIN & REGISTRATION
$lang['WELCOME'] = 'Welcome to igniCAD!';
$lang['LOG_IN'] = 'Login';
$lang['REGISTRATION'] = 'Registration';
$lang['USER_NAME'] = 'User name';
$lang['PASSWORD'] = 'Password';
$lang['FULL_NAME'] = 'Full name';
$lang['EMAIL_ADDR'] = 'Email';
$lang['PHONE_NUM'] = 'Phone number (digits only)';
$lang['PLEASE_FILL_ALL_FIELDS'] = 'Fill all required fields!';
$lang['FORGOT_PASSWORD'] = 'Forgot my password';
$lang['RESET_PASSWORD'] = 'Change password';
$lang['CURRENT_PASSWORD'] = 'Current password';
$lang['NEW_PASSWORD'] = 'New password';
$lang['SUBMIT'] = 'Submit';
$lang['BACK'] = 'Back';
$lang['PASSWORD_CHANGED'] = 'Password is changed';
$lang['YOUR_PASSWORD_CHANGED'] = 'We have changed your password';
$lang['LOGOUT'] = 'Logout';
$lang['SUCCESSFULLY_LOGGED_OUT'] = 'You logged out successfully';
$lang['CONFIRM_CODE'] = 'Confirmation code';
$lang['PASSWORD_RESET_CONFIRM_EMAIL'] = 'We send you a confirmation mail. Please click on the link for your new password';
$lang['PASSWORD_RESET_CONFIRM_EMAIL_SENT'] = 'Confirmation email is sent';
$lang['PASSWORD_RESET_SUCCESSFUL'] = 'Changing password is successful';
$lang['NEW_PASSWORD_SENT'] = 'We have sent your new password in email';
$lang['THANK_YOU'] = 'Thank you';
$lang['SUCCESSFULLY_CONFIRMED_REGISTRATION'] = 'You successfully confirmed your registration';
$lang['REGISTRATION_CONFIRM_LINK_SENT'] = 'We have sent you a confirmation email. Please click on the link to confirm your registration';
// $lang['SHOW'] = 'Show'; pwdwidget.js megoldani!!!

// ERROR MESSAGES
$lang['PROVIDE_USER_NAME'] = 'Please enter your user name';
$lang['PROVIDE_PASSWORD'] = 'Please enter password';
$lang['PROVIDE_FULL_NAME'] = 'Please enter your full name';
$lang['PROVIDE_EMAIL_ADDR'] = 'Please enter your email address';
$lang['PROVIDE_VALID_EMAIL_ADDR'] = 'Email address is invalid';
$lang['PROVIDE_PHONE_NUM'] = 'Please enter your phone number';
$lang['PROVIDE_VALID_PHONE_NUM'] = 'Please use digits only';
$lang['WRONG_USER_NAME_OR_PASSWORD'] = 'Login failed. Invalid user name or password';
$lang['WRONG_CONFIRM_CODE'] = 'Invalid or expired confirmation code';
$lang['OLD_PASSWORD_DO_NOT_MATCH'] = 'Current password is invalid';
$lang['NO_USER_WITH_THIS_EMAIL'] = 'No user is registered with this email: ';
$lang['THIS_EMAIL_ALREADY_REGISTERED'] = 'This email address is already registered';
$lang['THIS_PHONE_ALREADY_REGISTERED'] = 'This phone number is already registered';
$lang['THIS_USER_NAME_ALREADY_REGISTERED'] = 'This user name is taken. Please pick another user name';
$lang['PROVIDE_CURRENT_PASSWORD'] = 'Enter current password';
$lang['PROVIDE_NEW_PASSWORD'] = 'Enter new password';
$lang['ALREADY_CONFIRMED_REGISTRATION'] = 'You have already confirmed your registration';
$lang['PROVIDE_CONFIRM_CODE'] = 'Enter confirmation code';

// USER & ADMIN EMAILS
$lang['EMAIL_SUBJECT_WELCOME'] = 'Welcome to igniCAD';
$lang['EMAIL_DEAR'] = 'Dear ';
$lang['EMAIL_CONGRATS_YOUR_REG_TO'] = 'Congratulations. Your registration to ';
$lang['EMAIL_WEBSITE_WAS_SUCCESS'] = ' igniCAD has been successful.';
$lang['EMAIL_REGARDS'] = 'Best regards: ';
$lang['EMAIL_SIGNATURE'] = 'igniCAD webmaster';
$lang['EMAIL_SUBJECT_REG_CONFIRMED'] = 'Registration confirmed: ';
$lang['EMAIL_NEW_USER_CONFIRMED_REG'] = 'New user has confirmed registration at: ';
$lang['EMAIL_NAME'] = 'Name: ';
$lang['EMAIL_EMAIL_ADDR'] = 'Email address: ';
$lang['EMAIL_SUBJECT_RESET_PASSWORD_REQUEST'] = 'Password change request: ';
$lang['EMAIL_YOU_REQUESTED_RESET_PASSWORD'] = 'You have requested to change your password on: ';
$lang['EMAIL_PLEASE_CLICK_LINK_TO_COMPLETE'] = 'Please click on the link for confirmation: ';
$lang['EMAIL_YOUR_NEW_PASSWORD_FOR'] = 'Your new igniCAD password: ';
$lang['EMAIL_YOUR_PASSWORD_RESET_YOUR_NEW_LOGIN'] = 'Your password has been changed. Your new login information: ';
$lang['EMAIL_USER_NAME'] = 'User name: ';
$lang['EMAIL_PASSWORD'] = 'Password: ';
$lang['EMAIL_LOG_IN_HERE'] = 'Log in here: ';
$lang['EMAIL_SUBJECT_CONFIRM_REG'] = 'Confirm your registration: ';
$lang['EMAIL_THANK_YOU_FOR_REGISTERING_AT'] = 'Thank you for your registration: ';
$lang['EMAIL_SUBJECT_NEW_REGISTRANT'] = 'New registration: ';
$lang['EMAIL_NEW_USER_REGISTERED_AT'] = 'New user registered at: ';
$lang['EMAIL_PHONE_NUM'] = 'Phone number: ';

/*
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
*/

?>