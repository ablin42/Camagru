var CURR_FILTER;
var FILTERS_INFO = [];
function getCursorPosition(e)
{
    let preview = document.getElementById('preview');
    let previewPos = preview.getBoundingClientRect();
    let left = e.clientX - previewPos.left;
    let top = e.clientY - previewPos.top;
    let width = preview.clientWidth;
    let height = preview.clientHeight;
    return [left, top, width, height];
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev, item) {
    CURR_FILTER = item;
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    if (CURR_FILTER === undefined)
        return;
    ev.preventDefault();
    let pos = getCursorPosition(event);
    let left = pos[0];
    let top = pos[1];
    if (left < 0)
        left = 0;
    else if (left > pos[2])
        left = left - 100;//half...
    if (top < 0)
        top = 0;
    else if (top > pos[3])
        top = top - 100;//half...

    left = left - 100;//half of the filter's width
    top = top - 100;//half of the filter's height
    document.getElementById(CURR_FILTER).setAttribute("style", `left: ${left}px; top: ${top}px;`);

    let filter_id = CURR_FILTER.split("_").pop();
    /* sauvegarde la position de chaque filter, l'envoie au fonction de rendering */
    let filterInfo = {

        "id" : filter_id,
        "id_name" : CURR_FILTER,
        "left" : left,
        "top" : top

    };
    FILTERS_INFO.push(filterInfo);
}