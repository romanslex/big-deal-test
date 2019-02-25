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
        getPlanets({commit, state}, payload) {
            return new Promise((resolve) => {
                if ((payload.page + payload.search) in state.getPlanetsCache) {
                    resolve(state.getPlanetsCache[payload.page]);
                    return;
                }

                axios
                    .get('/data/planets', {
                        params: {
                            page: payload.page,
                            search: payload.search
                        }
                    })
                    .then(response => {
                        commit('setGetPlanetsResultToCache', {
                            key: payload.page + payload.search,
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