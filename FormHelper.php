
<?PHP
class FormHelper
{
    public static function checkField(string $name) : FALSE|string
    {
        if (!isset($_POST[$name]) || empty($_POST[$name]))
        {
            return false;
        }
        
        return $_POST[$name];
    }
}
?>