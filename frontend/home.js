const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
if(params.search){
  const form = document.getElementById('form-search')
  form.children[0].value = params.search
  form.children[1].click()
}
async function search(value){
    $.get("https://www.googleapis.com/youtube/v3/search?key=AIzaSyCkzcwSJNguHaybXQyYwZmfcpPEo4fVYQ8&type=video&part=snippet&maxResults=10&q="+value, function(data, status){
        console.log(data)
        document.getElementById('hasil').innerHTML = ''
        data.items.forEach(element => {
       const elmnt = document.getElementById('result').children[0].cloneNode(true)
       elmnt.style.display = 'block'
    elmnt.children[0].children[0].children[0].children[0].href = "https://www.youtube.com/embed/"+element.id.videoId
    elmnt.children[0].children[0].children[0].children[0].children[0].src = element.snippet.thumbnails.medium.url
    elmnt.children[0].children[0].children[1].children[0].href = 'downloadVideo.html?id='+element.id.videoId+"&search="+value;
    elmnt.children[0].children[0].children[1].children[1].href = 'downloadAudio.html?id='+element.id.videoId+"&search="+value;
    elmnt.children[0].children[0].children[1].children[3].children[0].innerHTML = 'Title : '+element.snippet.channelTitle
    elmnt.children[0].children[0].children[1].children[3].children[1].innerHTML = 'Description : '+element.snippet.description
    elmnt.children[0].children[0].children[1].children[4].setAttribute("href", element.snippet.thumbnails.medium.url)
    // console.log(element.snippet.thumbnails.default.url)
    // console.log(elmnt)
    document.getElementById('hasil').append(elmnt)
   });
  });
}
