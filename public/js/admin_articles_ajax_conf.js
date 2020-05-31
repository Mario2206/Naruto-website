let url = 'api/admin/set-online-state/articles';
let checkboxAjax = new CheckboxSender(document.querySelectorAll(' input[type="checkbox"]'))
checkboxAjax.urlRequest = url