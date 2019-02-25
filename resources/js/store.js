import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        planetsCache: {}
    },
    mutations: {
        setGetPlanetsResultToCache(state, payload){
            state.planetsCache[payload.key] = payload.value
        }
    },
    actions: {
        getPlanets({commit, state}, page) {
            return new Promise((resolve) => {
                if(page in state.planetsCache){
                    resolve(state.planetsCache[page]);
                    return;
                }

                axios
                    .get('/data/planets', {
                        params: {page: page}
                    })
                    .then(response => {
                        commit('setGetPlanetsResultToCache', {
                            key: page,
                            value: response.data
                        });
                        resolve(response.data);
                    })
                    .catch(error => console.log(error));
            });
        },
        getPlanetData({commit, state}, planetId){
            return new Promise((resolve) => {
                axios
                    .get('/data/planets/' + planetId)
                    .then(response => {
                        resolve(response.data);
                    })
                    .catch(error => console.log(error));
            })
        }
    }
});

export default store;