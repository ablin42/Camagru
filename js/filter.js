function applyFilter(filter)
{
    var emeraude = document.getElementById('emeraude');
    var turquoise = document.getElementById('turquoise');
    var pourpre = document.getElementById('pourpre');
    var ocre = document.getElementById('ocre');
    var ivoire = document.getElementById('ivoire');
    var ebene = document.getElementById('ebene');
    var gein = document.getElementById('gein');
    var ouga = document.getElementById('ouga');
    var ben = document.getElementById('ben');
    var solomonk = document.getElementById('solomonk');
    var rdv = document.getElementById('rdv');
    var comte = document.getElementById('comte');

    //uncheck the previously checked box if you check another box
    if (emeraude.checked && filter !== "emeraude.png")
        emeraude.checked = false;
    else if (turquoise.checked && filter !== "turquoise.png")
        turquoise.checked = false;
    else if (pourpre.checked && filter !== "pourpre.png")
        pourpre.checked = false;
    else if (ocre.checked && filter !== "ocre.png")
        ocre.checked = false;
    else if (ivoire.checked && filter !== "ivoire.png")
        ivoire.checked = false;
    else if (ebene.checked && filter !== "ebene.png")
        ebene.checked = false;
    else if (gein.checked && filter !== "gein.png")
        gein.checked = false;
    else if (ouga.checked && filter !== "ouga.png")
        ouga.checked = false;
    else if (ben.checked && filter !== "ben.png")
        ben.checked = false;
    else if (solomonk.checked && filter !== "solomonk.png")
        solomonk.checked = false;
    else if (rdv.checked && filter !== "rdv.png")
        rdv.checked = false;
    else if (comte.checked && filter !== "comte.png")
        comte.checked = false;

    //check if a box is checked to allow taking picture
    if (emeraude.checked || turquoise.checked || pourpre.checked || ocre.checked || ivoire.checked || ebene.checked ||
        gein.checked || ouga.checked || ben.checked|| solomonk.checked || rdv.checked || comte.checked)
        document.getElementById('startbutton').removeAttribute('disabled');
    else
        document.getElementById('startbutton').setAttribute('disabled', '');
}
