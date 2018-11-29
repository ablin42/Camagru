function applyFilter(filter)
{
    var emeraude = document.getElementById('emeraude');
    var turquoise = document.getElementById('turquoise');
    var pourpre = document.getElementById('pourpre');
    var ocre = document.getElementById('ocre');
    var ivoire = document.getElementById('ivoire');
    var ebene = document.getElementById('ebene');
    var sixdofus = document.getElementById('6dofus');
    var brak = document.getElementById('brak');
    var bonta = document.getElementById('bonta');
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
    else if (sixdofus.checked && filter !== "6dofus.png")
        sixdofus.checked = false;
    else if (brak.checked && filter !== "brak.png")
        brak.checked = false;
    else if (bonta.checked && filter !== "bonta.png")
        bonta.checked = false;
    else if (solomonk.checked && filter !== "solomonk.png")
        solomonk.checked = false;
    else if (rdv.checked && filter !== "rdv.png")
        rdv.checked = false;
    else if (comte.checked && filter !== "comte.png")
        comte.checked = false;

    //check if a box is checked to allow taking picture
    if (emeraude.checked || turquoise.checked || pourpre.checked || ocre.checked || ivoire.checked || ebene.checked ||
        sixdofus.checked || brak.checked || bonta.checked|| solomonk.checked || rdv.checked || comte.checked)
        document.getElementById('startbutton').removeAttribute('disabled');
    else
        document.getElementById('startbutton').setAttribute('disabled', '');
}
