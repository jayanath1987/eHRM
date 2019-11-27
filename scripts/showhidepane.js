

function displayLayer(panelNo) {

	switch(panelNo) {
          	case 1 : showPane('personal');break;
          	case 2 : showPane('job');break;
          	case 3 : showPane('dependents');break;
          	case 4 : showPane('contacts'); break;
          	case 5 : showPane('emgcontacts'); break;
          	case 6 : showPane('attachments'); break;
          	case 7 : break;
          	case 8 : break;
          	case 9 : showPane('education'); break;
          	case 10 : showPane('immigration'); break;
          	case 11 : showPane('languages');break;
          	case 12 : showPane('licenses'); break;
          	case 13 : showPane('memberships'); break;
          	case 14 : showPane('payments'); break;
          	case 15 : showPane('report-to'); break;
          	case 16 : showPane('skills'); break;
          	case 17 : showPane('work-experiance'); break;
          	case 18 : showPane('tax'); break;
          	case 19 : showPane('direct-debit'); break;
          	case 20 : showPane('custom'); break;
          	case 21 : showPane('photo'); break;
                case 22 : showPane('ebexam'); break;
                case 23 : showPane('servicerec'); break;
	}
}

function showPane(paneId) {
	var allPanes = new Array('personal','job','dependents','contacts','emgcontacts','attachments','education','immigration','languages','licenses',
				'memberships','payments','report-to','skills','work-experiance', 'tax', 'direct-debit','custom', 'photo','ebexam','servicerec');
	var numPanes = allPanes.length;
	for (i=0; i< numPanes; i++) {
	    pane = allPanes[i];
	    if (pane != paneId) {
	    	var paneDiv = document.getElementById(pane);
	    	if (paneDiv.className.indexOf('currentpanel') > -1) {
	    		paneDiv.className = paneDiv.className.replace(/\scurrentpanel\b/,'');
	    	}

	    	// style link
	    	var link = document.getElementById(pane + 'Link');
	    	if (link && (link.className.indexOf('current') > -1)) {
	    	    link.className = '';
	    	}
	    }
	}

	var currentPanel = document.getElementById(paneId);
	if (currentPanel.className.indexOf('currentpanel') == -1) {
		currentPanel.className += ' currentpanel';
	}
	var currentLink = document.getElementById(paneId + 'Link');
	if (currentLink && (currentLink.className.indexOf('current') == -1)) {
	    currentLink.className = 'current';
	}

}


function showPhotoHandler() {
	displayLayer(21);
}

function showAddPane(paneName) {
	//YAHOO.OrangeHRM.container.wait.show();

	addPane = document.getElementById('addPane'+paneName);
        summaryPane = document.getElementById('summaryPane'+paneName);
	editPane = document.getElementById('editPane'+paneName);
	parentPane = document.getElementById('parentPane'+paneName);

	if (addPane && addPane.style) {
		addPane.style.display = tableDisplayStyle;
	} else {
		return;
	}

	if (editPane && parentPane) {
		parentPane.removeChild(editPane);
	}

	//YAHOO.OrangeHRM.container.wait.hide();
}

function showPaneData(paneName) {
	//YAHOO.OrangeHRM.container.wait.show();

	pane = document.getElementById(paneName);

	if (pane && pane.style) {
            pane.style.display = 'block';
	} else {
		return;
	}

	//YAHOO.OrangeHRM.container.wait.hide();
}

function hidePaneData(paneName) {
	//YAHOO.OrangeHRM.container.wait.show();

	pane = document.getElementById(paneName);

	if (pane && pane.style) {
            pane.style.display = 'none';
	} else {
		return;
	}

	//YAHOO.OrangeHRM.container.wait.hide();
}

function showHideSubMenu(link) {

    var uldisplay;
	var newClass;

	if (link.className == 'expanded') {

		// Need to hide
	    uldisplay = 'none';
	    newClass = 'collapsed';

	} else {

		// Need to show
	    uldisplay = 'block';
	    newClass = 'expanded';
	}

    var parent = link.parentNode;
    uls = parent.getElementsByTagName('ul');
	for(var i=0; i<uls.length; i++) {
	    ul = uls[i].style.display = uldisplay;
	}

	link.className = newClass;
}

tableDisplayStyle = "table";
