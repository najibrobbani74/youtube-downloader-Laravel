const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
document.getElementById("back-button").href = 'home.html?search='+params.search
// console.log(params)
$.get("http://localhost:8000/api/youtube/download/mp3/"+params.id,{dataType:'jsonp'},function(data){
    console.log(data)
    data.map((a)=>{
        const parent = document.getElementById('result')
        const clone = parent.children[0].cloneNode(true)
        clone.hidden = false
        clone.children[0].children[0].href = a.url
        clone.children[1].innerHTML = a.mimeType
        clone.children[2].innerHTML = a.audioQuality.replace("AUDIO_QUALITY_",'')
        // clone.children[3].innerHTML = a.width
        // clone.children[4].innerHTML = a.height
        parent.append(clone)
    })
})
