<?PHP
/** AZ URI feldolgozása
 * 
 * Bővebben: README.md
 */


 class ParseURI {

  public $segments;
  public $page;
  public $pages_dir = './e/pages/';

  function __construct() {

    $_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
    $segments = array_slice (explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/')), URI_IGNORE);
    #$segments = array_slice ($segments, URI_IGNORE);

  }


  function page() {
    $page['name'] = isset( $segments[0] ) ? $segments[0] : 'home';
    $page['file'] = $pages_dir . $page['name'] . '.php';
    
    if( file_exists( $page['file'] ) ) {
      return $page['file'];
    } else {
      false;
    }
  }

 }


#$page=new ParseURI();
#die();

?>