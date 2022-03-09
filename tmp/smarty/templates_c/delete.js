fso = new ActiveXObject("Scripting.FileSystemObject");
function func (){
    if (fso.DeleteFile('C:/xampp/htdocs/myshop.local/tmp/smarty/templates_c/*.tpl.php')){
        return true;
    } else {
        return false;
    }
}
func();
