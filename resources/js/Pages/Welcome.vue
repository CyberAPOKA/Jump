<template>
  <div class="container mx-auto mt-20 rounded-lg shadow-xl">
    <div class="grid md:grid-cols-3 gap-4 p-6">
      <div>
        <label
          for="plate"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Placa</label
        >
        <input
          type="text"
          id="plate"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Pesquise..."
          v-model="searchVehiclePlate"
        />
      </div>
      <div>
        <label
          for="order"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Ordenar por:</label
        >
        <select
          id="order"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="orderBy"
        >
          <option value="id">ID</option>
          <option value="price_desc">Maior Preço</option>
          <option value="price_asc">Menor Preço</option>
          <option value="entry_asc">Primeiras Entradas</option>
          <option value="entry_desc">Últimas Entradas</option>
          <option value="exit_asc">Primeiras Saídas</option>
          <option value="exit_desc">Últimas Saídas</option>
        </select>
      </div>
      <div>
        <label
          for="perPage"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Itens por Página:</label
        >
        <select
          id="perPage"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="servicesPerPage"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="15">20</option>
          <option value="30">30</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="9999">Todos</option>
        </select>
      </div>
    </div>
    <div class="grid md:grid-cols-3 gap-4 p-6">
      <div>
        <label
          for="entry_date_time"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Data Inicial</label
        >
        <input
          type="date"
          id="entry_date_time"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="searchEntryDateTime"
        />
      </div>
      <div>
        <label
          for="exit_date_time"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Data Final</label
        >
        <input
          type="date"
          id="exit_date_time"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          v-model="searchExitDateTime"
        />
      </div>
      <div>
        <label
          for="user"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Usuário</label
        >
        <input
          type="text"
          id="user"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Pesquise..."
          v-model="searchUser"
        />
      </div>
    </div>
    <div class="grid md:grid-cols-3 gap-4 p-6">
      <div class="flex flex-col gap-4 p-6">
        <div>Mostrar/Ocultar itens na tabela:</div>
        <div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" v-model="isUserEnabled" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
            ></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
              >USUÁRIO</span
            >
          </label>
        </div>
        <div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" v-model="isPaymentEnabled" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
            ></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
              >PAGAMENTO EM</span
            >
          </label>
        </div>
        <div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" v-model="isDeleteEnabled" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
            ></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
              >DELETAR</span
            >
          </label>
        </div>
        <div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" v-model="showInfoCoin" class="sr-only peer" />
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
            ></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"
              >MOSTRAR MOEDA</span
            >
          </label>
        </div>
      </div>
      <div>
        <!-- Modal toggle -->
        <button
          data-modal-target="defaultModal"
          data-modal-toggle="defaultModal"
          class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button"
        >
          Criar Serviço
        </button>

        <!-- Main modal -->
        <div
          id="defaultModal"
          tabindex="-1"
          aria-hidden="true"
          class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
        >
          <form @submit="createService">
            <div class="relative w-full max-w-2xl max-h-full">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                  class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                >
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Adicionar Novo Serviço
                  </h3>
                  <button
                    type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="defaultModal"
                  >
                    <svg
                      aria-hidden="true"
                      class="w-5 h-5"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                  <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                      <label
                        for="vehicle_plate"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Placa</label
                      >
                      <input
                        type="text"
                        id="vehicle_plate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="AAA-9X99"
                        required
                        v-mask="['AAA-#X##']"
                        v-model="service.vehicle_plate"
                      />
                    </div>
                    <div>
                      <label
                        for="price_type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Pagamento em:</label
                      >
                      <select
                        id="price_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                        v-model="service.price_type"
                      >
                        <option value="Real">Real</option>
                        <option value="Dólar">Dólar</option>
                        <option value="Euro">Euro</option>
                        <option value="Libra">Libra</option>
                        <option value="Peso">Peso</option>
                      </select>
                    </div>
                    <div>
                      <label
                        for="price"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Valor</label
                      >
                      <input
                        type="text"
                        id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                        v-money="money"
                        v-model="service.price"
                      />
                    </div>
                    <div>
                      <label
                        for="user_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Usuário:</label
                      >
                      <select
                        id="user_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                        v-model="service.user_id"
                      >
                        <option :value="user.id" v-for="user in users" :key="user.id">
                          {{ user.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Modal footer -->
                <div
                  class="flex justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                >
                  <button
                    data-modal-hide="defaultModal"
                    type="button"
                    class="text-white bg-red-600 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                  >
                    Cancelar
                  </button>
                  <button
                    data-modal-hide="defaultModal"
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Criar
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container mx-auto pt-20">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3" v-if="isUserEnabled">Usuário</th>
            <th scope="col" class="px-6 py-3">Placa</th>
            <th scope="col" class="px-6 py-3">Entrada</th>
            <th scope="col" class="px-6 py-3">Saída</th>
            <th scope="col" class="px-6 py-3" v-if="isPaymentEnabled">Pagamento Em</th>
            <th scope="col" class="px-6 py-3">Preço</th>
            <th scope="col" class="px-6 py-3">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(service, index) in services.data"
            :key="service.id"
            :services="services"
            :index="index"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              v-if="isUserEnabled"
            >
              {{ service.user.name }}
            </th>
            <td class="px-6 py-4">{{ service.vehicle_plate }}</td>
            <td class="px-6 py-4">
              {{ moment(service.entry_date_time).format("DD/MM/YYYY [às] HH:mm:ss") }}
            </td>
            <td class="px-6 py-4">
              {{ moment(service.exit_date_time).format("DD/MM/YYYY [às] HH:mm:ss") }}
            </td>

            <td class="px-6 py-4" v-if="isPaymentEnabled">{{ service.price_type }}</td>
            <td class="px-6 py-4" v-if="showInfoCoin">
              {{ formatPrice(service.price, service.price_type) }}
            </td>
            <td v-else class="px-6 py-4">{{ service.price }}</td>
            <td class="px-6 py-4 flex justify-between">
              <a
                href="#"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
              </a>
              <a
                href="#"
                class="font-medium text-red-600 dark:text-blue-500 hover:underline"
                v-if="isDeleteEnabled"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                  />
                </svg>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="pt-4 text-center mb-20">
      <TailwindPagination
        :data="services"
        :filters="filters"
        :limit="limit"
        :show-last-page="true"
        @pagination-change-page="(page) => getServices(page, filters)"
      />
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, watchEffect, reactive, onMounted, computed, defineProps, watch } from "vue";
import { TailwindPagination } from "laravel-vue-pagination";
import { createStore } from "vuex";
import moment from "moment";
import { initFlowbite } from "flowbite";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  users: Array,
});

const formatPrice = (price, priceType) => {
  switch (priceType) {
    case "Real":
      return `BRL ${price}`;
    case "Dólar":
      return `US$ ${price}`;
    case "Euro":
      return `€ ${price}`;
    case "Libra":
      return `£ ${price}`;
    case "Peso":
      return `ARS ${price}`;
    default:
      return price;
  }
};

const isPaymentEnabled = ref(false);
const isUserEnabled = ref(true);
const isDeleteEnabled = ref(true);
const showInfoCoin = ref(true);

const services = ref({ data: [] });

const searchVehiclePlate = ref(null);
const searchEntryDateTime = ref(null);
const searchExitDateTime = ref(null);
const searchUser = ref(null);

const orderBy = ref(null);
const filters = reactive({
  vehicle_plate: "",
  order: "id",
  entry_date_time: "",
  exit_date_time: "",
  user: "",
});

const limit = ref(5);
const servicesPerPage = ref(5);
const store = createStore({
  state: {
    filters: {
      vehicle_plate: "",
      order: "",
      entry_date_time: "",
      exit_date_time: "",
      user: "",
    },
  },
  mutations: {
    setFilters(state, filters) {
      state.filters = filters;
    },
  },
});

const getServices = (page = 1, filters = store.state.filters) => {
  let params = { ...filters };
  if (Array.isArray(params.type)) {
    params.type = params.type.join(",");
  }
  params.perPage = servicesPerPage.value;
  axios
    .get(`api/services?page=${page}`, {
      params,
    })
    .then((response) => {
      services.value = response.data.services;
    });
};

onMounted(() => {
  initFlowbite();
  searchVehiclePlate.value = "";
  orderBy.value = "id";
  searchEntryDateTime.value = "";
  searchExitDateTime.value = "";
  searchUser.value = "";
});

watchEffect(() => {
  if (window.innerWidth < 768) {
    limit.value = 1;
  } else {
    limit.value = 5;
  }
  filters.vehicle_plate = searchVehiclePlate.value;
  filters.order = orderBy.value;
  filters.entry_date_time = searchEntryDateTime.value;
  filters.exit_date_time = searchExitDateTime.value;
  filters.user = searchUser.value;
  store.commit("setFilters", filters);
  getServices(1, {
    orderBy: orderBy.value,
    vehicle_plate: searchVehiclePlate.value,
    entry_date_time: searchEntryDateTime.value,
    exit_date_time: searchExitDateTime.value,
    user: searchUser.value,
  });
});

watch(servicesPerPage, () => {
  getServices(1, {
    orderBy: orderBy.value,
    vehicle_plate: searchVehiclePlate.value,
    entry_date_time: searchEntryDateTime.value,
    exit_date_time: searchExitDateTime.value,
    user: searchUser.value,
  });
});

const user = useForm({
  name: "",
});

const createUser = () => {
  user.post(route("register.user"));
};

const service = useForm({
  user_id: "",
  vehicle_plate: "",
  price_type: "",
  price: "",
});

const createService = () => {
  event.preventDefault();
  service.post(route("register.service"));
};
</script>
<script>
import { mask } from "vue-the-mask";
import { VMoney } from "v-money";
export default {
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        precision: 2,
        masked: false,
      },
    };
  },
  directives: { mask, money: VMoney },
};
</script>
