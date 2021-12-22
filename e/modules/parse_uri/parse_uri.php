<?PHP
/** AZ URI feldolgozása
 * 
 * Bővebben: README.md
 */


 class ParseURI {

  public $segments;
  public $page;


  function __construct() {

    $_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
    $this->$segments = explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/'));
    $this->$segments = array_slice ($this->$segments, URI_IGNORE);

  }
  

  function is_page($page_check) {

    $page_check = isset( $page_check ) ? $page_check : $segments[0];
    $page_file = PAGES_DIR . $page_check . '.php';
    
    if( file_exists($page_file) ) {
      return $page_file;
    } else {
      false;
    }
    #unset($page_file);
  }

  function page() {

    $this->$page['name'] = isset( $this->$segments[0] ) ? $this->$segments[0] : 'home';

    if( $this->$page['file'] = $this->is_page($this->$page['name']) ) {
        include $this->$page['file'];
    } else {
      print 'ismeretlen hiba';
    }

  }

 }


#$page=new ParseURI();
#die();

?>