function addDays(date, days) {
    var result = new Date(date);
    result.setDate(date.getDate() + days);
    return result;
}

Date.prototype.isSameDateAs = function (pDate) {
    return (
      this.getFullYear() === pDate.getFullYear() &&
      this.getMonth() === pDate.getMonth() &&
      this.getDate() === pDate.getDate()
    );
}

Date.prototype.isBeforeDate = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    return tDate < pDate
}

Date.prototype.isAfterDate = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    return tDate > pDate
}

Date.prototype.isSameDate = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    return tDate == pDate
}

Date.prototype.isSameMonth = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    return tDate.getMonth() == pDate.getMonth() 
}

Date.prototype.isBeforeMonth = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    if(tDate.getFullYear() > pDate.getFullYear()) return false;
    if(tDate.getMonth() > pDate.getMonth()) return false;
    return true;
}

Date.prototype.isAfterMonth = function (d) {
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    if(tDate.getFullYear() < pDate.getFullYear()) return false;
    if(tDate.getMonth() < pDate.getMonth()) return false;
    return true;
}

Date.prototype.isSameMonth = function(d){
    var tDate = new Date(this.getFullYear(), this.getMonth(), this.getDate());
    var pDate = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    if(tDate.getFullYear() != pDate.getFullYear()) return false;
    if(tDate.getMonth() != pDate.getMonth()) return false;
    return true;
}
