let url= "api/admin/set-online-state/characters";

let checkboxAjax = new CheckboxSender(document.querySelectorAll(' input[type="checkbox"]'))
checkboxAjax.urlRequest = url