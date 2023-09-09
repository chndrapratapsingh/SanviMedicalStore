if(localStorage.getItem('row') != null)
{
    
    let a = document.getElementById("main1");
    let b = localStorage.getItem("row");
    a.innerHTML = b;
}


function add() {
    let popup = document.getElementById("popupoff");
    popup.removeAttribute('id');
    popup.setAttribute('id', 'popupon')
    popup.innerHTML = `<input id="input1" type="file" name="Mediation" id="NewMediation">
    <input id="MediationName" type="text" placeholder="Enter Mediation Name">
    <input id="MediationQuantity" type="number" name="NewMediation" id="NewMediation" placeholder="Enter Quintity Only Number">
    <button onclick="DonePopup()">submit</button>`;
    let blur = document.getElementById("transparentOff");
    blur.removeAttribute("id");
    blur.setAttribute("id","transparentOn");
}

function DonePopup() {
// //work

    let img = document.getElementById("input1").value;
    let name = document.getElementById("MediationName").value;
    // console.log(name)
    let Quintity = document.getElementById("MediationQuantity").value;
    let html = '';
    let count;
    if(localStorage.getItem('row') == null)
    {
        html = '';
        count = 1;
    }
    else{
        html = localStorage.getItem('row'); 
        count = localStorage.getItem("count")
    }


    html = html + `<div class="row">
                    <input type="checkbox" class="ItemCheckBoxOff" id="check${count}">
                    <img src="${img}" alt="">
                    <h4>${name}</h4>
                    <p>Quintity <b>${Quintity}</b></p>
                </div>`;
    localStorage.setItem(`row`,html);
    count++;
    localStorage.setItem('count',count)
    let a = document.getElementById("main1");
    let b = localStorage.getItem("row");
    a.innerHTML = b;
    
// //DonePopupOff
    let popup = document.getElementById("popupon");
    popup.removeAttribute('id');
    popup.setAttribute('id', 'popupoff')
    popup.innerHTML = '';
    
    let blur = document.getElementById("transparentOn");
    blur.removeAttribute("id");
    blur.setAttribute("id","transparentOff");
}

function asideOn() {
    let aside = document.getElementById("asideOff");
    aside.removeAttribute('id');
    aside.setAttribute('id','asideOn');
    aside.innerHTML = ` <div id="AsideTop">
                        <h4>Menu</h4>
                        <button onclick="AsideOff()"><img src="menu.png" alt=""></button>
                        </div>`;
                        
    let blur = document.getElementById("transparentOff");
    blur.removeAttribute("id");
    blur.setAttribute("id","transparentOn");
}

function AsideOff(){
    let aside = document.getElementById("asideOn");
    aside.removeAttribute("id");
    aside.setAttribute('id','asideOff');
    aside.innerHTML = ``;
    
    let blur = document.getElementById("transparentOn");
    blur.removeAttribute("id");
    blur.setAttribute("id","transparentOff");
}

function remove(){
    let count = localStorage.getItem("count");
    for(let i = 1;i<count;i++){
        let box = document.querySelector(".ItemCheckBoxOff");
        box.removeAttribute("class");
        box.setAttribute("class","ItemCheckBoxOn");
    }
    let Remover = document.getElementById("Remover");
    Remover.removeAttribute("onclick");
    Remover.setAttribute("onclick","Remover()");
}

function Remover(){
    let count = localStorage.getItem("count");
    for(let i = 1;i<count;i++){
        let item = document.getElementById(`check${i}`)
        if(item.checked == true)
        {
            
        }
    }
}