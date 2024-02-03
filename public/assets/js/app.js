import axios from 'axios';

async function getStarWarsPlanets(){
    try {
        const {data} = await axios.get('https://swapi.dev/api/planets');
        console.log(data);
    } catch (error) {
       console.log(error.response);
    }
}

getStarWarsPlanets();