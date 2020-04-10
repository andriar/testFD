export const generateQuery = (params: any) => {
  const queries = [];
  if (params.filter && Array.isArray(params.filter)) {
    for (const key in params.filter) {
      if (Object.values(params.filter[key])) {
        queries.push(`filter[]=${Object.values(params.filter[key]).join(',')}`);
      }
    }
  } else if (params.filter) {
    queries.push(`filter[]=${Object.values(params.filter).join(',')}`);
  }
  if (params.sort) {
    queries.push(`sort=${Object.values(params.sort).join(',')}`);
  }
  if (params.per_page) {
    queries.push(`per_page=${params.per_page}`);
  }
  if (params.page) {
    queries.push(`page=${params.page}`);
  }
  if (params.join) {
    queries.push(`join=${params.join}`);
  }
  if (params.interval) {
    queries.push(`interval=${params.interval}`);
  }
  if (params.before) {
    queries.push(`before=${params.before}`);
  }
  if (params.limit) {
    queries.push(`limit=${params.limit}`);
  }
  if (params.where_has && Array.isArray(params.where_has)) {
    // queries.push(`where_has[]=${Object.values(params.where_has).join(',')}`);
    for (const key in params.where_has) {
      if (Object.values(params.where_has[key])) {
        queries.push(
          `where_has[]=${Object.values(params.where_has[key]).join(',')}`,
        );
      }
    }
  }
  return queries.join('&');
};
