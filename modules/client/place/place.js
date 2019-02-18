console.log(`Loaded Place`);

let place = {};
const apiKey = `AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k`;
var googledirectionsDisplay;
var googledirectionsService;

function getAllUrlParams() {
  const search = new URLSearchParams(window.location.search);
  console.log('PLACE',search.get('place'))
  return search.get("place")
}

function docid(name) {
  return document.getElementById(name);
}

function formatImages() {
  place.photos.map(image => {
    let imageUri = `https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=${
      image.photo_reference
    }&key=${apiKey}`;
    docid("imageReference").innerHTML += `<img src='${imageUri}'>`;
  });
}

function formatRating(count) {
  if (count >= 5) return "★★★★★";
  if (count >= 4) return "★★★★☆";
  if (count >= 3) return "★★★☆☆";
  if (count >= 2) return "★★☆☆☆";
  if (count >= 1) return "★☆☆☆☆";
  if (count >= 0) return "☆☆☆☆☆";
}

function formatReviews() {
  place.reviews.map(review => {
    // console.log( review )
    docid("reviews").innerHTML += `
    <span>
      <h3 style="display:inline;"> <b>${review.author_name}</b></h3> - <i>${formatRating(review.rating)}</i>
      <br/>
      <br/>
      <blockquote>${review.text}</blockquote>
      <sup style="float:right">${review.relative_time_description}</sup>
    </span>
    <br/>
    <br/>
    `;
  });
}

function setDetails() {
  docid("title").innerHTML = place.name;
  docid("description").innerHTML = place.adr_address;
  docid("rating").innerHTML = formatRating(place.rating);
  docid("phoneNum").innerHTML = place.international_phone_number;
  docid("avail").innerHTML = place.opening_hours.open_now ? "OPEN" : "CLOSED";
  docid("url").href = `index.php?mod=terminal&place_id=${place.place_id}&name=${place.name}&lng=${place.geometry.location.lng}&lat=${place.geometry.location.lat}`;
  formatImages();
  formatReviews();
}



function getData(uri) {
  console.log("URI", uri)
  console.log(uri);
  const params = {
    headers: {
      "Content-type": "application/json"
    },
    dataType: "text",
    crossdomain: true
  };
  
  axios
    .get(uri, params)
    .then(function(response) {
      place = response.data.result;
      console.log(place);
      setDetails();
    })
    .catch(e => console.error(e.message));
}

document.addEventListener("DOMContentLoaded", function(event) {
  getData(
    `${CORS_FIX}https://maps.googleapis.com/maps/api/place/details/json?placeid=${getAllUrlParams()}&key=AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k`
  );
  getReviews(getAllUrlParams())
});

function getReviews( id ) {
  let uri = `https://treatout.000webhostapp.com/modules/api/getcommentsandrate.php?placeid=${id}`
  console.log("URI", uri)
  console.log(uri);
  const params = {
    headers: {
      "Content-type": "application/json"
    },
    dataType: "text",
    crossdomain: true
  };
  axios
  .get(uri, params)
  .then(function(response) {
    console.log(response)
    response.data.map( review => {
      docid("comments").innerHTML += `
      <span>
        <h3 style="display:inline;"> <b>${review.username}</b></h3> - <i>${formatRating(review.rate)}</i>
        <br/>
        <br/>
        <blockquote>${review.comment}</blockquote>
         <sup style="float:right">${review.date}</sup>
      </span>
      <br/>
      <br/>
      `;  
    })
  })
  .catch(e => console.error(e.message));
}
