/************************************************
 * JS to load the inject an iframe into the page.
 ***********************************************/

console.log("*** Load the iFrame");
let frame= '<iframe id="frame-panel" src="http://192.168.10.10/api/gateway?token=%TOKEN%"></iframe>';
document.getElementById('app').innerHTML = frame;
console.log("*** Finished loading the iFrame");
