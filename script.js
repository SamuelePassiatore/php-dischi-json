const {createApp} = Vue;
const apiUri = 'http://localhost/php-dischi-json/api.php';
const app = createApp ({
data (){
    return {
        showAlbum: false,
        discs: [],
        selectedGenre: '',
        genres: ['Rock','Pop', 'Jazz', 'Metal'],
    }
},
methods: {
  fetchApi(endpoint, target){
    axios.get(endpoint).then(res => {
      this[target] = res.data;
    })
  },
  filterDiscs(){
    let endpoint = apiUri;
    if(this.selectedGenre) endpoint += `?genre=${this.selectedGenre}`;
    this.fetchApi(endpoint, 'discs');
  },
  sortGenres() {
    this.genres.sort();
  },

  toggleAlbum(event, index) {
    this.showAlbum = index;
    console.log(index);
  }
},

created (){
  this.fetchApi(apiUri, 'discs');
  this.sortGenres();
}
});

app.mount('#app');