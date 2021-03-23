var assert = require("assert")
require('../calendar.js')

describe('Array', function(){
		describe('#indexOf()', function(){
			it('should return -1 when the value is not present', function(){
				assert.equal(-1, [1,2,3].indexOf(5));
				assert.equal(-1, [1,2,3].indexOf(0));
			})
		})
})

describe('Date',function(){
	describe('#isSameDateAs',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			assert.equal(t.isSameDateAs(s),true);
			})
		})
	});


describe('Date',function(){
	describe('#isSameDateAs',function(){
		it('should return false',function(){
			var t = new Date();
			var s = new Date();
			s.setMonth(t.getMonth-2);
			assert.equal(t.isSameDateAs(s),false);
			})
		})
	});


describe('Date',function(){
	describe('#isBeforeDate same date',function(){
		it('should return false',function(){
			var t = new Date();
			var s = new Date();
			// s.setMonth(t.getMonth-2);
			assert.equal(t.isBeforeDate(s),false);
			})
		})
	});

describe('Date',function(){
	describe('#isBeforeDate earlier date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()-2);
			assert.equal(t.isBeforeDate(s),true);
			})
		})
	});

describe('Date',function(){
	describe('#isBeforeDate later date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()+2);
			assert.equal(t.isBeforeDate(s),false);
			})
		})
	});

describe('Date',function(){
	describe('#isAfterDate same date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			// t.setMonth(s.getMonth());
			assert.equal(t.isAfterDate(s),false);
			})
		})
	});

describe('Date',function(){
	describe('#isAfterDate earlier date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()-2);
			assert.equal(t.isAfterDate(s),false );
			})
		})
	});

describe('Date',function(){
	describe('#isAfterDate later date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()+2);
			assert.equal(t.isAfterDate(s),true );
			})
		})
	});

describe('Date',function(){
	describe('#isSameDate same date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			//t.setMonth(s.getMonth()+2);
			assert.equal(t.isSameDate(s),false );
			})
		})
	});

describe('Date',function(){
	describe('#isSameDate before date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()-2);
			assert.equal(t.isSameDate(s),false );
			})
		})
	});

describe('Date',function(){
	describe('#isSameDate after date',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setMonth(s.getMonth()+2);
			assert.equal(t.isSameDate(s),false );
			})
		})
	});
describe('Date',function(){
	describe('#isSameYear same year',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			// t.setFullYear(s.getFullyear()+2);
			assert.equal(t.isSameMonth(s),true );
			})
		})
	});

describe('Date',function(){
	describe('#isSameYear before year',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setFullYear(s.getFullYear()+2);
			assert.equal(t.isSameMonth(s),true );
			})
		})
	});
describe('Date',function(){
	describe('#isSameYear after year',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			t.setFullYear(s.getFullYear()-2);
			assert.equal(t.isSameMonth(s),true );
			})
		})
	});

	
describe('Date',function(){
	describe('#isSameYear earlier month',function(){
		it('should return false',function(){
			var t = new Date();
			var s = new Date();
			// t.setFullYear(s.getFullyear()+2);
			t.setMonth(s.getMonth()-2);
			assert.equal(t.isSameMonth(s),false );
			})
		})
	});
describe('Date',function(){
	describe('#isSameYear later month',function(){
		it('should return true',function(){
			var t = new Date();
			var s = new Date();
			// t.setFullYear(s.getFullyear()+2);
			t.setMonth(s.getMonth()+2)
			assert.equal(t.isSameMonth(s),false );
			})
		})
	});
