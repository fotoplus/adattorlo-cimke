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
    $this->page['name'] = isset( $segments[0] ) ? $segments[0] : 'home';
    $this->page['file'] = PAGES_DIR . $this->page['name'] . '.php';
    
    if( file_exists( $this->page['file'] ) ) {
      return $this->page['file'];
    } else {
      false;
    }
  }

 }


#$page=new ParseURI();
#die();

?>