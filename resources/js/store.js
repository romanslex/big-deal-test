import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        getPlanetsCache: {},
        getPlanetDataCache: {}
    },
    mutations: {
        setGetPlanetsResultToCache(state, payload) {
            state.getPlanetsCache[payload.key] = payload.value
        },
        setGetPlanetDataResultToCache(state, payload) {
            state.getPlanetDataCache[payload.key] = payload.value
        }
    },
    actions: {
        getPlanets({commit, state}, page) {
            return new Promise((resolve) => {
                if (page in state.getPlanetsCache) {
                    resolve(state.getPlanetsCache[page]);
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
                        response.data.data.map(i => commit('setGetPlanetDataResultToCache', {
                            key: i.id,
                            value: i
                        }));
                        resolve(response.data);
                    })
                    .catch(error => console.log(error));
            });
        },
        getPlanetData({commit, state}, planetId) {
            return new Promise((resolve) => {
                if (planetId in state.getPlanetDataCache) {
                    resolve(state.getPlanetDataCache[planetId]);
                    return;
                }

                axios
                    .get('/data/planets/' + planetId)
                    .then(response => {
                        commit('setGetPlanetDataResultToCache', {
                            key: planetId,
                            value: response.data
                        });
                        resolve(response.data);
                    })
                    .catch(error => console.log(error));
            })
        }
    }
});

export default store;