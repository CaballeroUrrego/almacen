
function getData(){
    let data =document.getElementById("input").value
    let content = document.getElementById("content")
    let url = "load.php"
    let formadata = new FormData()
    formadata.append("campo",input)

    fetch (url,{
        method: "POST",
        body: formadata }).then(response => response.json())
    .then (data => {
        content.innerHTML = data.result
   
    }).catch(error => console.error('Error:', error));
}