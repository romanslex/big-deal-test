import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        planetsCache: []
    },
    actions: {
        getPlanets({commit}, page) {
            return new Promise((resolve) => {
                axios
                    .get('/data/planets', {
                        params: {page: page}
                    })
                    .then(response => {
                        console.log('from store');
                        resolve(response.data);
                    })
                    .catch(error => console.log(error));
            });
        }
    }
});

export default store;