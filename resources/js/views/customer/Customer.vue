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
            Customers
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
            :items="customers.data"
            :options.sync="options"
            :server-items-length="customers.total"
            :loading="loading"
            class="elevation-1"
          >
            <template v-slot:item.actions="{ item }">
              <v-btn class="ma-2" tile outlined color="success" @click="openDialog(item)">
                <v-icon left>mdi-pencil</v-icon>Edit
              </v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog v-model="dialog" persistent max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline">{{ isEdit ? 'Edit' : 'Add' }} Customer</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field label="Name" required v-model="customer.name"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field label="Deskripsi" hint="alamat customer" v-model="customer.address"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field required label="No telephone" v-model="customer.telephone"></v-text-field>
              </v-col>
            </v-row>
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
  </v-app>
</template>

<script lang="ts" src="./customer.ts"></script>