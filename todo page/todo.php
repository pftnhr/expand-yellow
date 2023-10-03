<!---------------------------
todo.php
Dexcription: This simple extension adds a new status "todo" to Yellow that I use to create a kind of dashboard that can only be accessed when I am logged in. See "navigation-snippet.html".

The todo.html is the associated layout file where I display drafts and unlisted pages.

Created by Robert Pfotenhauer on 03.10.23.
---------------------------->


<?php
// Todo extension

class YellowTodo {
	const VERSION = "0.8.18";
	public $yellow;         // access to API

	// Handle initialisation
	public function onLoad($yellow) {
		$this->yellow = $yellow;
	}

	// Handle page meta data
	public function onParseMetaData($page) {
		if ($page->get("status")=="todo") $page->visible = false;
	}

	// Handle page layout
	public function onParsePageLayout($page, $name) {
		if ($this->yellow->page->get("status")=="todo" && $this->yellow->lookup->getRequestHandler()=="core") {
			$errorMessage = "";
			if ($this->yellow->extension->isExisting("edit")) {
				$errorMessage .= "<a href=\"".$this->yellow->page->get("editPageUrl")."\">";
				$errorMessage .= $this->yellow->language->getText("todoPageError")."</a>";
			}
			$this->yellow->page->error(420, $errorMessage);
		}
	}
}