<?PHP
/** AZ URI feldolgozása
 * 
 * Bővebben: README.md
 */


 class ParseURI {

  public $segments;
  public $page;
  protected $pages_dir = './e/pages/';

  function __construct() {

    $_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
    $segments = explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/'));
    $segments = array_slice ($segments, URI_IGNORE);

  }
  

  function is_page($page_check) {

    $page_check = isset( $page_check ) ? $page_check : $segments[0];
    $page_file = $pages_dir . $page_check . '.php';
    
    if( file_exists($page_file) ) {
      return $page_file;
    } else {
      false;
    }
    #unset($page_file);
  }

  function page() {

    $page['name'] = isset( $segments[0] ) ? $segments[0] : 'home';

    if( $page['file'] = is_page($page['name']) ) {
        include $page['file'];
    } else {
      print 'ismeretlen hiba';
    }

  }

 }


#$page=new ParseURI();
#die();

?>