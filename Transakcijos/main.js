let rinkoskaina = $("input[name*='price']");
rinkoskaina.attr("readonly","readonly");

let pardavimodata = $("input[name*='timestampx']");
pardavimodata.attr("readonly","readonly");

let kcekiekis = $("input[name*='kce']");
kcekiekis.attr("readonly","readonly");

$(".btnremove").click( e =>
{

});

function refreshPage(){
    window.location.reload();
}