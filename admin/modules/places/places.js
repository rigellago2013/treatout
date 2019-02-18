console.log(SERVER_URL);

function findGetParameter(parameterName) {
  var result = null,
      tmp = [];
  location.search
      .substr(1)
      .split("&")
      .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
      });
  return result;
}

const service = `${findGetParameter('service')}`
const query = `${findGetParameter('query')}`

let next_page = null

document.addEventListener("DOMContentLoaded", function(event) {

  document.getElementById("placeLists").innerHTML = "";

  if( service != 'search'){

    console.log(service)

    if( service === 'tourist+spot' || service === 'restaurant') {

      view(`${service}+in`, 'Bacolod', next_page )

    }else{
      
      document.getElementById("placeLists").innerHTML = `<div class="inner content"><br/><br/><h2> Sorry we are unable to get what you requested for</h2><br/><br/></div>`
    }

  }else{
    view(`${query}`, 'Bacolod', next_page )
    
  }  
});

// Bottom Listener
window.onscroll = function(ev) {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    if(next_page){
      console.log('loading next page')
      view(service, 'Bacolod', next_page )
    }
    next_page = null
  }
};


function getData(url) {
  const container = document.getElementById("placeLists");
  axios.get(url).then(function(response) {
    const results = response.data;
    console.log(results);
    results.map(function(place) {
      container.innerHTML += 
      `<section>
        <div class="content card">
          <header>
            <h3>${place.name}</h3>
          </header>
          <p>Can't Decide or She does not know where to go or eat? Oh boy let help you with that</p>
        </div>
      </section>`
    });
  }).catch( function(e){
    console.error(e)
    contaianer.innerHTML = `<br/><div class="inner content"><h2> Sorry we are unable to get what you requested for</h2></div>`
  })
}

// Temp Functions

function formatRating( count ){
  if(count >= 5) return '★★★★★'
  if(count >= 4) return '★★★★☆'
  if(count >= 3) return '★★★☆☆'
  if(count >= 2) return '★★☆☆☆'
  if(count >= 1) return '★☆☆☆☆'
  if(count >= 0) return '☆☆☆☆☆'
}

function getGmapData(url) {

  axios.get(url).then(function(response) {

    const results = response.data.results;
    const next_page_token = response.data.next_page_token
    console.log(response);
    const container = document.getElementById("placeLists");

    results.map(function(place) {
      let name = escape(place.name)
      let id = escape(place.place_id)
      container.innerHTML += 
      `<section>
        <div class="content card" onclick="goToPage('${id}','${name}')">
          <header>
            <h3>${place.name}</h3>
          </header>
          <h2>${formatRating(place.rating)}</h2>
          <p>${place.formatted_address}</p>
        </div>
      </section>`
    });

    const buttons = document.getElementById("buttons");

    if (next_page_token) {
      next_page = next_page_token
    } else {
      next_page = null
    }

  });

}

function goToPage( url) {
  
 location = url

}

function view(query, place, nextpage ) {

  if( nextpage ) return getGmapData(`${CORS_FIX}https://maps.googleapis.com/maps/api/place/textsearch/json?query=${query}+${place}&key=AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k&pagetoken=${next_page}`);
  getGmapData(`${CORS_FIX}https://maps.googleapis.com/maps/api/place/textsearch/json?query=${query}+${place}&key=AIzaSyDWJ95wDORvWwB6B8kNzSNDfVSOeQc8W7k`);
}