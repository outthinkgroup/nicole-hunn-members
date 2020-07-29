<script>
  export let ingredients;
</script>

<style>
  table {
    border: none;
    overflow: hidden;
    border-radius: 3px;
    margin-bottom: 5px;
  }
  thead {
    background: hsl(221, 37%, 66%);
    font-size: 12px;
    color: var(--blue-dark);
  }
  th {
    border: none;
    padding: 5px 8px;
  }
  td {
    white-space: nowrap;
    border: none;
  }
  tr {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #efefef;
  }
  tr:nth-child(even) {
    background: hsl(221, 37%, 96%);
  }

  tbody {
    font-size: 14px;
    padding: 0.35em 8px;
  }

  .weight {
    font-weight: 600;
  }
  .unit {
    font-weight: 400;
  }

  .table-wrapper {
    height: 385px;
    margin-bottom: 5px;
  }
</style>

<div class="table-wrapper">
  <table style="color:black;" class="shadow-sm">
    <thead>
      <tr>
        <th>Ingredients</th>
        <th>Grams</th>
      </tr>

    </thead>
    <tbody>
      <!-- <div class="table-body-wrapper"> -->
      {#each ingredients as ingredient}
        <tr>
          <td class="name">{ingredient.name}</td>
          <td class="weight">
            {ingredient.grams}
            <span class="unit">grams</span>
          </td>
        </tr>
      {/each}
      <!-- </div> -->
    </tbody>
  </table>
</div>
