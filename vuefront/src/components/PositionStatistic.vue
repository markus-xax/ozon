<template>
  <v-card-text
      class="d-flex justify-end card-body"
  >
    <v-col
        v-if="project"
        cols="1"
    >
      <div class="pb-1" v-text="top1Percent + '%'"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="top1"></div>
        <div class="diffvalue"
             :class="{
            'negative': top1Changed < 0
               }"
             v-if="top1Changed !== 0" v-text="top1Changed"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          color="black"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Top 1</span>
        </template>
        <span>Количество ключевых слов в ТОП1</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
    >
      <div class="pb-1" v-text="top4Percent + '%'"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="top4"></div>
        <div class="diffvalue"
             :class="{
            'negative': top4Changed < 0
               }"
             v-if="top4Changed !== 0" v-text="top4Changed"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          color="black"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Top 4</span>
        </template>
        <span>Количество ключевых слов в ТОП4</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
        class="text-center"
    >
      <div class="pb-1" v-text="top12Percent + '%'"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="top12"></div>
        <div class="diffvalue"
             :class="{
            'negative': top12Changed < 0
               }"
             v-if="top12Changed !== 0" v-text="top12Changed"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Top 12</span>
        </template>
        <span>Количество ключевых слов в ТОП12</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
        class="text-center"
    >
      <div class="pb-1" v-text="top100Percent + '%'"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="top100"></div>
        <div class="diffvalue"
             :class="{
            'negative': top100Changed < 0
               }"
             v-if="top100Changed !== 0" v-text="top100Changed"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Top 100</span>
        </template>
        <span>Количество ключевых слов в ТОП100</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
        class="text-center"
    >
      <div class="pt-1"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="avgPos"></div>
        <div class="diffvalue"
             :class="{
            'negative': avgChanged < 0
               }"
             v-if="avgChanged !== 0" v-text="avgChanged"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          color="black"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Ср поз</span>
        </template>
        <span
        >Среднее арифметическое позиций всех ключевых слов</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
        class="text-center"
    >
      <div class="pt-1" v-text="totalResultPercent"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="totalHasResult + '/' + wordsCount"></div>
        <div class="diffvalue"
             :class="{
            'negative': project.changeTotal < 0
               }"
             v-if="project.changeTotal !== 0" v-text="project.changeTotal"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          color="black"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Всего</span>
        </template>
        <span
        >Суммарное количество ключевых слов с позициями / всего обработанных ключевых слов (позиции были сняты) за выбранный период на текущий момент времени</span>
      </v-tooltip>
    </v-col>

    <v-col
        cols="1"
        class="text-center"
    >
      <div class="pt-1"></div>
      <div class="mb-1 d-flex justify-space-between">
        <div class="value" v-text="wordsCount"></div>
        <div class="diffvalue"></div>
      </div>
      <v-tooltip
          location="top"
          width="200"
          color="black"
          transition="fade-transition"
      >
        <template v-slot:activator="{ props }"
        >
          <span v-bind="props">Кл. слов</span>
        </template>
        <span
        >Количество всех ключевых слов, добавленные в проект</span>
      </v-tooltip>
    </v-col>
  </v-card-text>
</template>

<script>
export default {
  name: "PositionStatistic",
  props: {
    project: {
      type: Object
    },
    sku: {
      type: Object
    },
    item: {
      type: Object
    }
  },
  mounted () {
  },
  computed: {
    wordsCount () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }

      return this.item.words.length
    },
    totalHasResult () {
      let total = 0
      if (!this.item.words || !this.item.words.length) {
        return total
      }
      this.item.words.forEach((word) => {
        let has = 0
        word.positions.forEach((result) => {
          if (result > 0) has++
        })
        if (has > 0) {
          total++
        }
      })
      return total
    },
    totalResultPercent () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      let result = this.totalHasResult / this.item.words.length * 100
      return Math.floor(result) + '%'
    },
    avgPos () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-1))
      })
      return Math.floor(phrases.reduce((a, b) => a + b, 0) / phrases.length)
    },
    avgPosPrev () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-2))
      })
      return Math.floor(phrases.reduce((a, b) => a + b, 0) / phrases.length)
    },
    avgChanged () {
      return this.avgPos - this.avgPosPrev
    },
    top100 () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-1))
      })
      let result = phrases.filter((position) => position && position <= 100)
      return result.length
    },
    top100Prev () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-2))
      })
      let result = phrases.filter((position) => position && position <= 100)
      return result.length
    },
    top100Changed () {
      return this.top100Prev - this.top100
    },
    top100Percent () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      return Math.floor(this.top100 / this.top100Prev * 100)
    },
    top12 () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-1))
      })
      let result = phrases.filter((position) => position && position <= 12)
      return result.length
    },
    top12Prev () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-2))
      })
      let result = phrases.filter((position) => position && position <= 12)
      return result.length
    },
    top12Changed () {
      return this.top12Prev - this.top12
    },
    top12Percent () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      return Math.floor(this.top12 / this.item.words.length * 100)
    },
    top4 () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-1))
      })
      let result = phrases.filter((position) => position && position <= 4)
      return result.length
    },
    top4Prev () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-2))
      })
      let result = phrases.filter((position) => position && position <= 4)
      return result.length
    },
    top4Changed () {
      return this.top4Prev - this.top4
    },
    top4Percent () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      return Math.floor(this.top4 / this.item.words.length * 100)
    },
    top1 () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-1))
      })
      let result = phrases.filter((position) => position && position <= 1)
      return result.length
    },
    top1Prev () {
      let phrases = []
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      this.item.words.forEach((phrase) => {
        phrases.push(phrase.positions.at(-2))
      })
      let result = phrases.filter((position) => position && position <= 1)
      return result.length
    },
    top1Changed () {
      return this.top1Prev - this.top1
    },
    top1Percent () {
      if (!this.item.words || !this.item.words.length) {
        return 0
      }
      return Math.floor(this.top1 / this.item.words.length * 100)
    }
  }
}
</script>

<style>
  .media-body tr{
    font-size: 13px;
  }
  .media-body td {
    padding: 6px;
  }
  .card-body .v-col div.mb-1 {
    display: flex;
    justify-content: center;
    align-items: center;
    line-height: 1;
    margin-bottom: 0!important;
  }
  .card-body .v-col div.mb-1 .value {
    font-size: 36px;
    font-weight: 300;
  }
  .card-body .v-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 0;
    max-width: 100%;
    flex: 0 0;
  }
  .card-body .v-col:not(:first-child) {
    padding-left: 40px;
  }
  .card-body .diffvalue {
    font-size: 13px;
    padding: 5px 6px;
    margin-left: 3px;
    vertical-align: text-top;
    background-color: rgba(54, 176, 87, 0.05);
    top: inherit;
  }
  .card-body .v-col > span{
    text-transform: uppercase;
    font-size: 11px;
    padding-top: 5px;
    color: #9d9d9d;
    white-space: nowrap;
  }
  .card-body .v-col .negative{
    background: rgba(235,87,87,.05);
    color: #eb5757;
  }
  .card-body .v-col .pb-1 {
    text-transform: uppercase;
    font-size: 11px;
    display: block;
    color: #9d9d9d;
  }
</style>
