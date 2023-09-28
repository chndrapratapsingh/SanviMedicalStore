<?php
    $server = 'localhost';
    $user = "username";
    $pass = '';
    $dbname = 'medical';
                        
    $conn = mysqli_connect($server,$user,$pass,$dbname);

    $result = mysqli_query($conn,"SELECT * FROM `sanvi medical` WHERE 1");

    $data = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanvi Medical</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="temp"></div>
    <header id="header">
        <div id="top">
            <!-- <img src="" alt=""> -->
            <h2>Sanvi Medical Store</h2>
        </div>
        <div id="menu">
            <button onclick="asideOn()"><img src="menu.png" alt="menu"></button>
        </div>
    </header>
    <div id="main">
        <div id="main1">
            <?php foreach($data as $row): ?>
                <div class="row">
                    <input type="checkbox" class="ItemCheckBoxOff" id="check${count}">
                    <h4 onclick="loadPage('<?= htmlspecialchars($row['photo']) ?>','<?= htmlspecialchars($row['Use']) ?>','<?= htmlspecialchars($row['Quantity']) ?>')"><?= htmlspecialchars($row['photo']) ?></h4>
                    <h4 onclick="loadPage('<?= htmlspecialchars($row['photo']) ?>','<?= htmlspecialchars($row['Use']) ?>','<?= htmlspecialchars($row['Quantity']) ?>')" ><?= htmlspecialchars($row['Name']) ?></h4>
                    <h4 onclick="loadPage('<?= htmlspecialchars($row['photo']) ?>','<?= htmlspecialchars($row['Use']) ?>','<?= htmlspecialchars($row['Quantity']) ?>')" ><?= htmlspecialchars($row['Use']) ?></h4>
                    <h4 onclick="loadPage('<?= htmlspecialchars($row['photo']) ?>','<?= htmlspecialchars($row['Use']) ?>','<?= htmlspecialchars($row['Quantity']) ?>')" ><?= htmlspecialchars($row['Eating Time']) ?></h4>
                    <p onclick="loadPage('<?= htmlspecialchars($row['photo']) ?>','<?= htmlspecialchars($row['Use']) ?>','<?= htmlspecialchars($row['Quantity']) ?>')" >Quintity <b><?= htmlspecialchars($row['Quantity']) ?></b></p>
                </div>
            <?php endforeach ?>
        </div>
        <div id="transparentOff">

        </div>
        <div id="asideOff">
            <!-- <h4>Welcome</h4>
            <hr>
            <p></p>
            <p>Contact</p>
            <p>Address</p>
            <p>Online</p> -->
        </div>
        <div id="popupoff">

        </div>
        <div id="plusIcon">
            <button onclick="add()"><img src="plus.png" alt="plus"></button>
        </div>
        <div id="RemoveIcon">
            <button id="Remover" onclick="remove()"><img src="bin.png" alt="plus"></button>
        </div>
    </div>
    <script>
                if(localStorage.getItem('count') != null)
                {
                    if(localStorage.length != localStorage.getItem('count'))
                    {
                        let j = 1;
                        let change = localStorage.getItem("count")
                        for(let i = 1;i<localStorage.getItem("count");i++)
                        {
                            if(localStorage.getItem(`Row${i}`) != null)
                            {
                                let temp = localStorage.getItem(`Row${j}`);
                                localStorage.setItem(`Row${i}`,temp);
                            }
                            else{
                                j++;
                                change--;
                                let temp = localStorage.getItem(`Row${j}`);
                                localStorage.setItem(`Row${i}`,temp);
                            }
                            j++;
                        }
                        localStorage.setItem("count",change)
                        localStorage.removeItem(`Row${change}`)
                    }
                }

                if(localStorage.getItem('Row1') != null)
                {
                    
                    let a = document.getElementById("main1");

                    for(let i = 1;i<localStorage.getItem("count");i++)
                    {
                        a.innerHTML += localStorage.getItem(`Row${i}`)
                    }

                }

                function add() {
                    let popup = document.getElementById("popupoff");
                    popup.removeAttribute('id');
                    popup.setAttribute('id', 'popupon')
                    popup.innerHTML = `
                    <form id="FormDataBase" action="database.php" method="post">
                        <input name="name" class="MediationName" type="text" placeholder="Enter Mediation Name"/>
                        <input name="use" class="MediationName" type="text" placeholder="Enter Your Name"/>
                        <input name="time" class="MediationName" type="text" placeholder="Enter Your Address"/>
                        <input name="image" class="MediationName" type="number" maxlength = "10" placeholder="Enter Your Phone Number"/>
                        <input name="Quin" id="MediationQuantity" type="number" name="NewMediation" id="NewMediation" placeholder="Enter Quintity Only Number"/>
                        <input type="submit" class="FormButton" value="Send" />
                        <button class="FormButton" onclick="DonePopup()">submit</button>
                    </form>
                    `;
                    let blur = document.getElementById("transparentOff");
                    blur.removeAttribute("id");
                    blur.setAttribute("id","transparentOn");
                }

                function DonePopup() {
                    // //work

                    let img = document.getElementById("input1").value;
                    let name = document.getElementBy("MediationName").value;
                    // console.log(name)
                    let Quintity = document.getElementById("MediationQuantity").value;
                    // let html = '';
                    let count;
                    if(localStorage.getItem('Row1') == null)
                    {
                        // html = '';
                        count = 1;
                    }
                    else{
                        // html = localStorage.getItem('row'); 
                        count = localStorage.getItem("count")
                    }


                    // html = html + `<div class="row">
                    //                 <input type="checkbox" class="ItemCheckBoxOff" id="check${count}">
                    //                 <img src="${img}" alt="">
                    //                 <h4>${name}</h4>
                    //                 <p>Quintity <b>${Quintity}</b></p>
                    //             </div>`;

                    let Align = `<div class="row">
                    <input type="checkbox" class="ItemCheckBoxOff" id="check${count}">
                    <img onclick="loadPage('${img}','${name}','${Quintity}')" src="${img}" alt="">
                    <h4 onclick="loadPage('${img}','${name}','${Quintity}')" >${name}</h4>
                    <p onclick="loadPage('${img}','${name}','${Quintity}')" >Quintity <b>${Quintity}</b></p>
                    </div>`;
                    localStorage.setItem(`Row${count}`,Align);

                    // localStorage.setItem(`row`,html);
                    count++;
                    localStorage.setItem('count',count)
                    let html1 = ``;
                    let a = document.getElementById("main1");
                    for(let i = 1;i<localStorage.getItem("count");i++)
                    {
                        html1 += localStorage.getItem(`Row${i}`);
                    }
                    a.innerHTML = html1;
                    //DonePopupOff
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
                            
                            let temp = ((item.id).split(''));
                            
                            localStorage.removeItem(`Row${temp[(temp.length-1)]}`)
                        }
                        let box = document.querySelector(".ItemCheckBoxOn");
                        box.removeAttribute("class");
                        box.setAttribute("class","ItemCheckBoxOff")
                    }
                    let remove = document.getElementById("Remover");
                    remove.removeAttribute("onclick");
                    remove.setAttribute("onclick","remove()")
                }



                function loadPage(img,name,quan){
                    let main = document.getElementById("main");
                    // localStorage.setItem("Main", `${main}`)
                    

                    // <h2 style="font-size:1rem;">Sanvi Medical Store</h2>
                    let header = document.getElementById("header");
                    header.innerHTML = `<div id="top">
                            <img onclick="Redirect()" src="arrow.png" alt="Back">
                        </div>
                        <div id="menu">
                            <button onclick="asideOn()"><img src="menu.png" alt="menu"></button>
                        </div>`;
                    // localStorage.setItem("header",`${header}`)
                    main.innerHTML = `<!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Chandrapratap Devloper</title>
                        <link rel="stylesheet" href="AutoPage.css">
                    </head>
                    <body>
                        <div id="main">
                            <div id="Mainimage">
                                <img src="generic-drug-drop-shipping-500x500.jpg" alt="Aclock">
                                <!--<img src="${img}" alt="Aclock">-->
                            </div>
                            <div id="MainDetails">
                                <h3>${name}</h3>
                                <p>Where Use :- I Dont Know</p>
                                <p>Eating Time :- Morning And Night</p>
                                <p>Quantity :- ${quan}</p>
                                <div id="comments">
                                    <p id="comment">Comment</p>
                                    <div id="commentCard">
                                        <h4>Devil</h4>
                                    <p>This Commnet Only Check This Is Work</p>
                                    </div>
                                </div>
                            </div>
                            <footer>
                                <Button id="AddCart">Add Cart</Button>
                                <Button id="BuyButton">Buy</Button>
                            </footer>
                        </div>
                    </body>
                    </html>`;
                }

                function Redirect(){
                    // let main = document.getElementById("main");
                    // main.innerHTML = localStorage.getItem("Main");
                    // let header = document.getElementById("header");
                    // header.innerHTML = localStorage.getItem("header")
                    document.location.reload()
                }

    </script>
    <script src="javascript.js"></script>
</body>
</html>
