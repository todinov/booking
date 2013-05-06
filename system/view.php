<?php
class BTemplate {
    protected $vars; /// Holds all the template variables
	protected $template_dir;

	// constructor
    // @param $tplfile string the file name you want to load
    public function BTemplate($tmpldir = 'templates/') {
		$this->template_dir = $tmpldir;
    }

    // Set a template variable.
    public function assign($name, $value) {
        $this->vars[$name] = is_object($value) ? $value->fetch() : $value;
    }

    // Open, parse, and return the template file.
    // @param $tplfile string the template file name
    public function fetch($tplfile = null) {
        extract($this->vars);				// Extract the vars to local namespace
        ob_start();							// Start output buffering
        include($this->template_dir.$tplfile); // Include the file
        $contents = ob_get_contents();		// Get the contents of the buffer
        ob_end_clean();						// End buffering and discard
        return $contents;					// Return the contents
    }
}


// An extension to Template that provides automatic caching of template contents.
class Template extends BTemplate {
    protected $cache_id;
	protected $cache_file;
    protected $expire;
    protected $cached;
	protected $cache_dir;

	// constructor
    // @param $cache_id string unique cache identifier
	// @param $expire int number of seconds the cache will live
    function Template($expire = 3600, $tmpldir = 'templates/', $cachedir = 'cache/') {
        $this->BTemplate($tmpldir);
		$this->cache_dir = $cachedir;
        $this->expire = $expire;
		
		if(!($this->is_cached())) {
			global $root;
			global $logged;
			global $platforms;
			
			$this->assign('app_name', 'mushroms');
			$this->assign('logged', $logged);
			$this->assign('root', $root);
			$this->assign('platforms', $platforms);
		}
	}

	public function is_cached() {
        if($this->cached) return true;
        // Passed a cache_id?
        if(!$this->cache_id) return false;
        // Cache file exists?
        if(!file_exists($this->cache_file)) return false;
        // Can get the time of the file?
        if(!($mtime = filemtime($this->cache_file))) return false;
        // Cache expired?
        if(($mtime + $this->expire) < time()) {
            @unlink($this->cache_file);
            return false;
        }else {
            $this->cached = true;
            return true;
        }
    }

	private function fetch_cache($tplfile){
        ob_start();							// Start output buffering
        include($tplfile);						// Include the file
        $contents = ob_get_contents();		// Get the contents of the buffer
        ob_end_clean();						// End buffering and discard
        return $contents;					// Return the contents
	}

    // This function returns a cached copy of a template (if it exists), otherwise, it parses it as normal and caches the content.
    public function display($tplfile, $cache_id = null) {
		$cache_id = $tplfile.$cache_id;
		$tplfilename = array_pop(explode('/', $tplfile));
		
		$this->cache_id = $cache_id ? $this->cache_dir . md5($cache_id) : $cache_id;
		$this->cache_file = $this->cache_id.'.'.$tplfilename;

        if($this->is_cached()){
			echo $this->fetch_cache($this->cache_file);
		}
        else {
            $contents = $this->fetch($tplfile);

			// Write the cache
			$success = file_put_contents($this->cache_file, $contents);
            if(!$success){
                die('Unable to write cache.');
            }else{
				echo $this->fetch_cache($this->cache_file);
			}
        }
    }
}

function insert($func, $name = ''){
	echo '<?php echo insert_'.$func.'("'.$name.'");?>';
}
