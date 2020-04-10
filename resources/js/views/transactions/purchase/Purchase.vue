<template>
  <v-app>
    <v-row>
      <v-col cols="3">
        <v-btn depressed color="primary" @click="dialog = true">Add</v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>
            Stock Transaction
            <v-spacer></v-spacer>
            <v-spacer></v-spacer>
            <v-text-field
              v-model="keyword"
              @change="search"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="purchases.data"
            :options.sync="options"
            :server-items-length="purchases.total"
            :loading="loading"
            class="elevation-1"
          >
            <template v-slot:item.actions="{ item }">
              <v-btn
                class="ma-2"
                tile
                outlined
                color="success"
                @click="openDetailDialog(item)"
              >Detail</v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog v-model="dialog" persistent max-width="1200px">
      <v-card>
        <v-card-title>
          <span class="headline">{{ isEdit ? 'Edit' : 'Add' }} Transaction</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field label="transaction code" required v-model="purchase.transaction_code"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field label="Total" hint="Total data" v-model="purchase.total"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <!-- <v-text-field label="Supplier" v-model="purchase.supplier_id"></v-text-field> -->
                <v-autocomplete
                  label="Supplier"
                  :items="suppliers"
                  item-value="id"
                  item-text="name"
                  v-model="purchase.supplier_id"
                ></v-autocomplete>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <!-- <v-text-field label="Detail Transaksi" v-model="purchase.details"></v-text-field> -->
                <v-btn color="blue darken-1" text @click="addGoods">Tambah Barang</v-btn>
              </v-col>
            </v-row>
            <div v-for="(items, index) in goodDetails" :key="index">
              <v-row>
                <v-col cols="4">
                  <v-autocomplete
                    label="Good"
                    :items="goods"
                    item-value="id"
                    item-text="name"
                    v-model="items.good_id"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="4">
                  <v-text-field label="Total" hint="Total" v-model="items.price"></v-text-field>
                </v-col>
                <v-col cols="2">
                  <v-text-field label="Qty" v-model="items.qty"></v-text-field>
                </v-col>
              </v-row>
            </div>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dissmiss">Cancel</v-btn>
          <v-btn
            v-if="!isEdit"
            color="blue darken-1"
            text
            @click="submit"
            :loading="loadingAction"
          >Save</v-btn>
          <v-btn
            v-else
            color="blue darken-1"
            text
            @click="submitUpdate"
            :loading="loadingAction"
          >Change</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogDetail" width="500">
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>TRANSACTION DETAIL</v-card-title>

        <v-card-text>
          <div v-for="(items, index) in purchase.details" :key="index">
            <v-row>
              <v-col cols="3">{{ items.name }}</v-col>
              <v-col cols="3">{{ items.price }}</v-col>
              <v-col cols="3">{{ items.qty }}</v-col>
              <!-- <v-col cols="3">{{ items.good_id }}</v-col> -->
            </v-row>
          </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="dialogDetail = false">CLOSE</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script lang="ts" src="./purchase.ts"></script>