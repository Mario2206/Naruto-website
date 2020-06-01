(function() {

    let button_like = document.querySelector('#button_like')
    let img_like = document.querySelector("#button_like img")
    let p_like = document.querySelector("#button_like p")

    let article_id = document.querySelector("#id_article").value
    let domain = new Ajax().domain

    button_like.addEventListener("click", (e)=>{
        
        e.preventDefault()

        let ajax = new Ajax("api/like/")
        ajax.post({article_id : article_id}).then(callback).catch((e)=>console.error(e))
    })

    function callback(response) {
        console.log(response);
        
        if(response === "add") {

            img_like.src = domain + "img/icons/icon_green_like.png"
            p_like.innerText = parseInt(p_like.innerText) + 1

        } else if (response === "delete") {
            
            img_like.src = "https://img.icons8.com/pastel-glyph/64/000000/facebook-like.png",
            p_like.innerText = parseInt(p_like.innerText) - 1

        } else if(response === "no identification") {

            alert("Il faut être connecté pour liker des articles")
            window.location.replace( domain +"connection/")

        }
        
    }

})()