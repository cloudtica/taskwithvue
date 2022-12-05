
import storageManagement from 'src/utils/storageManagement';


export const API_BASE_URL = 'http://127.0.0.1:8000';



export const api = {

  login_api: API_BASE_URL + '/api/login',
  register_admin: API_BASE_URL + '/api/register_admin',
  get_admins: API_BASE_URL + '/api/get_admins',
  delete_admin: API_BASE_URL + '/api/delete_admin',
  update_admin: API_BASE_URL + '/api/update_admin',
  update_password: API_BASE_URL + '/api/update_password',
  logout_user: API_BASE_URL + '/api/logout_user',
  get_home_data: API_BASE_URL + '/api/get_home_data',
  update_home_content: API_BASE_URL + '/api/update_home_content',
  get_about_data: API_BASE_URL + '/api/get_about_data',
  update_about_content: API_BASE_URL + '/api/update_about_content',
  update_ctemplate: API_BASE_URL + '/api/update_ctemplate',
  update_ztemplate: API_BASE_URL + '/api/update_ztemplate',
  get_examples_data: API_BASE_URL + '/api/get_examples_data',
  get_ctemplate: API_BASE_URL + '/api/get_ctemplate',
  get_ztemplate: API_BASE_URL + '/api/get_ztemplate',
  update_examples_content: API_BASE_URL + '/api/update_examples_content',
  add_case_studies: API_BASE_URL + '/api/add_case_studies',
  add_client_logos: API_BASE_URL + '/api/add_client_logos',
  add_slides: API_BASE_URL + '/api/add_slides',
  add_team_member: API_BASE_URL + '/api/add_team_member',
  add_thanks: API_BASE_URL + '/api/add_thanks',
  get_involved_data: API_BASE_URL + '/api/get_involved_data',
  update_involved_content: API_BASE_URL + '/api/update_involved_content',
  update_contact_content: API_BASE_URL + '/api/update_contact_content',
  get_fossilfreezones_data: API_BASE_URL + '/api/get_fossilfreezones_data',
  update_fossilfreezones_content: API_BASE_URL + '/api/update_fossilfreezones_content',
  add_faqs: API_BASE_URL + '/api/add_faqs',
  get_all_images: API_BASE_URL + '/api/get_all_images',
  get_teams: API_BASE_URL + '/api/get_teams',
  get_footer_data: API_BASE_URL + '/api/get_footer_data',
  get_contact_data: API_BASE_URL + '/api/get_contact_data',
  get_thanks: API_BASE_URL + '/api/get_thanks',
  get_personal: API_BASE_URL + '/api/get_personal',
  update_personal: API_BASE_URL + '/api/update_personal',
  get_faqs: API_BASE_URL + '/api/get_faqs',
  delete_slider: API_BASE_URL + '/api/delete_slider',
  delete_logo: API_BASE_URL + '/api/delete_logo',
  delete_member: API_BASE_URL + '/api/delete_member',
  update_member: API_BASE_URL + '/api/update_member',
  update_thanks: API_BASE_URL + '/api/update_thanks',
  update_footer: API_BASE_URL + '/api/update_footer',
  update_faqs: API_BASE_URL + '/api/update_faqs',
  update_rules: API_BASE_URL + '/api/update_rules',
  update_cases: API_BASE_URL + '/api/update_cases',
  delete_thanks: API_BASE_URL + '/api/delete_thanks',
  delete_faqs: API_BASE_URL + '/api/delete_faqs',
  delete_cases: API_BASE_URL + '/api/delete_cases',
  delete_rules: API_BASE_URL + '/api/delete_rules',
  delete_cform: API_BASE_URL + '/api/delete_cform',
  delete_zform: API_BASE_URL + '/api/delete_zform',
  get_cases: API_BASE_URL + '/api/get_cases',
  get_contactform_data: API_BASE_URL + '/api/get_contactform_data',
  get_zonesform_data: API_BASE_URL + '/api/get_zonesform_data',
  contact_form: API_BASE_URL + '/api/contact_form',
  zones_form: API_BASE_URL + '/api/zones_form',
  add_rules: API_BASE_URL + '/api/add_rules',
  get_rules: API_BASE_URL + '/api/get_rules',
  download_file: API_BASE_URL + '/api/download_file',
  download_file_new: API_BASE_URL + '/api/download_file_new',
};


// export function getAuthorizationToken() {
//   return 'Basic ' + btoa(process.env.APP_VUE_SERVICE_USERNAME + ':' + process.env.APP_VUE_SERVICE_PASSWORD);
// }

export function getAuthorizationToken() {
    return 'Bearer ' + storageManagement.methods.getDataFromLocalStorageByKey('token');
}

// export function getClientAuthorization() {
//   return 'Basic ' + btoa(process.env.APP_VUE_CLIENT_ID + ':' + process.env.APP_VUE_CLIENT_SECRET);
// }

