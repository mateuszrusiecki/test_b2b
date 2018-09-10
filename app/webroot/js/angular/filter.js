app.filter('htmldecode', function ($sce) {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        return $sce.trustAsHtml(decodeURI(data));
    }
});
app.filter('mailhtmldecode', function ($sce) {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        return $sce.trustAsHtml(data);
    }
});
app.filter('sumPaymentInTeam', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        var sum = 0;
        angular.forEach(data, function (v) {
            sum += v.price * v.time;
        })
        return sum;
    }
});
app.filter('obj2arr', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }
        var arr = [];
        angular.forEach(data, function (v) {
            arr.push(v);
        })
        return arr;
    }
});
app.filter('candidates', function () {
    return function (data, flag) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (!flag) {
            return data;
        }
        var arr = [];
        angular.forEach(data, function (v) {
            if (!v.Profile.user_id) {
                arr.push(v);
            }
        })
        return arr;
    }
});
app.filter('sumPaymentInAll', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        var sum = 0;
        angular.forEach(data, function (team) {
            angular.forEach(team.payments, function (v) {
                sum += v.price * v.time;
            })
        })
        return sum;
    }
});
app.filter('sumMarginInAll', function ($filter) {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        var sum = 0;

        angular.forEach(data, function (team) {
            sum += (($filter('sumPaymentInTeam')(team.payments) / ((100 - (team.section.margin_percentage || 0)))) * 100) - $filter('sumPaymentInTeam')(team.payments);
            //sum += $filter('sumPaymentInTeam')(team.payments) * ((team.section.margin_percentage || 0) / 100);
        })
        return sum;
    }
});
app.filter('sumBufferInAll', function ($filter) {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        var sum = 0;
        angular.forEach(data, function (team) {
            sum += $filter('sumPaymentInTeam')(team.payments) * ((team.section.buffer_percentage || 0) / 100);
        })
        return sum;
    }
});
app.filter('formatPrice', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        return data.toFixed(2);
    }
});
app.filter('length', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return 0;
        }
        var tmp = 0;
        angular.forEach(data, function () {
            ++tmp;
        });
        return tmp;
    }
});
app.filter('pag', function () {
    return function (input, current, limit) {

        if (typeof input == 'undefined') {
            return false;
        }
        if (typeof current == 'undefined') {
            current = 1;
        }
        if (typeof limit == 'undefined') {
            limit = 10;
        }

        var out = [],
                i, n, tmp = 0;
        i = (current * limit) - limit; //aktualna_strona * limit - limit -> początek
        n = (current * limit); // koniec

        angular.forEach(input, function (value) {

            if (tmp >= i && tmp < n) {
                out.push(value);
            }
            ++tmp;
        });


        return out;
    };
});
app.filter('deleted', function ($filter) {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }
        var arr = [];
        angular.forEach(data, function (v) {
            if (!(typeof v.delete != 'undefinded' && v.delete == true)) {
                arr.push(v);
            }
        })
        return arr;
    }
});
app.filter('fontSize', function ($filter) {
    return function (data) {
        var maxSize = 34;
        var minSize = 20;
        var deg = 0.1;
        var long = '';
        if (typeof data == 'undefined') {
            return maxSize;
        }
        long = data + '';
        if (long < 6) {
            return maxSize;
        }
        long = long.length - 5;
        var size = maxSize - (maxSize * (long * deg));
        return (size <= minSize) ? minSize : size;
    }
});
app.filter('sectionFilter', function () {
    return function (data, section) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (typeof section == 'undefined') {
            return data;
        }
        section = 1 * section;
        if (!(section > 0)) {
            return data;
        }
        var arr = [];
        angular.forEach(data, function (v) {
            if (
                    (typeof v.UserSection != 'undefined' && typeof v.UserSection.section_id != 'undefined' && v.UserSection.section_id == section) ||
                    (typeof v.ProjectFile != 'undefined' && typeof v.ProjectFile.section_id != 'undefined' && v.ProjectFile.section_id == section) ||
                    (typeof v.section_id != 'undefined' && v.section_id == section)
                    ) {
                arr.push(v);
            }
        })
        return arr;
    }
});
app.filter('projectListFilter', function () {
    return function (data, filters, type) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (typeof filters == 'undefined') {
            return data;
        }

        type = (type) ? false : true;
        var fil = [];
        angular.forEach(filters, function (status, field) {
            if (status) {
                fil.push(field);
            }
        });

        var arr = [];
        var flag;
        angular.forEach(data, function (v) {
            flag = true;
            angular.forEach(fil, function (f) {
                if (v[f] == type) {
                    flag = false;
                }
            });

            if (flag) {
                arr.push(v);
            }
        })

        return arr;
    }
});
app.filter('timelineMin', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        var time;
        var max;
        var min;
        angular.forEach(data, function (v) {
            if (null !== v.start && v.type != 'today') {
                time = new Date(v.start.Y, v.start.m, v.start.d);
                v.time = time.getTime() / 100000;

                if (typeof min == 'undefined') {
                    min = v.time;
                }
                if (typeof max == 'undefined') {
                    max = v.time;
                }
                max = Math.max(max, v.time);
                min = Math.min(min, v.time);
            }
        });

        angular.forEach(data, function (v, k) {
            v.max = max;
            v.min = min;
            v.ratio = (max - min) / 100;
            if (v.type == 'today' && (v.time > v.max || v.time < v.min)) {
                delete data.splice(k, 1);
                ;
            }
        });
        return data;
    }
});
app.filter('timelineMinDone', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        var time;
        var max;
        var maxDone = 0;
        var min;
        angular.forEach(data, function (v) {
            if (null !== v.start) {
                time = new Date(v.start.Y, v.start.m, v.start.d);
                v.time = time.getTime() / 100000;

                if (typeof min == 'undefined') {
                    min = v.time;
                }
                if (typeof max == 'undefined') {
                    max = v.time;
                }
                if (v.done) {
                    maxDone = Math.max(maxDone, v.time);
                }
                max = Math.max(max, v.time);
                min = Math.min(min, v.time);
            }
        });
        maxDone = Math.max(maxDone, min);
        var ret = (maxDone - min) / ((max - min) / 100);
        return ret;
    }
});
app.filter('filterHrFiles', function ($filter) {
    return function (data, fields) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (typeof fields == 'undefined') {
            return data;
        }
        data = $filter('filter')(data, fields.search);
        data = $filter('filterHrUser')(data, fields);
        data = $filter('filterHrDate')(data, fields);
        data = $filter('sectionFilter')(data, fields.section_id);
        return data;
    }
});
app.filter('filterHrDate', function ($filter) {
    return function (data, fields) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (
                !(typeof fields.data_from !== 'undefined' && fields.data_from) &&
                !(typeof fields.data_to !== 'undefined' && fields.data_to) &&
                !(typeof fields.data_last !== 'undefined' && fields.data_last)
                ) {
            return data;
        }
        var tmp = {};
        var arr = [];
        angular.forEach(data, function (v) {
//data od do
            var v2 = {};
            if (typeof v.Invoice !== 'undefined') {
                v2 = v.Invoice;
            }
            if (typeof v.ProjectFile !== 'undefined') {
                v2 = v.ProjectFile;
            }
            tmp.modified = $filter('str2Date')(v2.created);
            tmp.data_from = $filter('str2Date')(fields.data_from);
            tmp.data_to = $filter('str2Date')(fields.data_to);
            if (typeof tmp.modified == 'undefined' || tmp.modified) {
                if (tmp.data_from) {
                    tmp.data_from.getTime();
                } else {
                    delete tmp.data_from;
                }
                if (tmp.data_to) {
                    tmp.data_to.getTime();
                } else {
                    delete tmp.data_to;
                }
//ostatnie dni
                if (fields.data_last) {
                    tmp.today = new Date()
                    tmp.data_from = new Date().setDate(tmp.today.getDate() - fields.data_last)
                    tmp.data_to = tmp.today.getTime();
                }
                if (typeof tmp.data_from == 'undefined' || !tmp.data_from) {
                    tmp.data_from = tmp.modified;
                }
                if (typeof tmp.data_to == 'undefined' || !tmp.data_to) {
                    tmp.data_to = tmp.modified;
                }

                if (tmp.modified >= tmp.data_from && tmp.modified <= tmp.data_to)
                {
                    arr.push(v);
                }
            }
        });
        return arr;
    }
});
app.filter('filterHrUser', function () {
    return function (data, fields) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (typeof fields.user_add == 'undefined' || !fields.user_add) {
            return data;
        }
        var arr = [];
        angular.forEach(data, function (v) {
            if (fields.user_add && (fields.user_add == v.ProjectFile.user_id))
            {
                arr.push(v);
            }
        });
        return arr;
    }
});
app.filter('str2Date', function () {
    return function (input) {
        if (typeof input == 'undefined') {
            return false;
        }

        var parts = input.split('-');
        if (typeof parts[2] == 'undefined') {
            return false;
        }
        // new Date(year, month [, day [, hours[, minutes[, seconds[, ms]]]]])
        return new Date(parts[0], parts[1] - 1, parts[2][0] + '' + parts[2][1]); // Note: months are 0-based

    }
});
app.filter('ucfirst', function () {
    return function (input) {
        if (typeof input == 'undefined') {
            return false;
        }

        return input.charAt(0).toUpperCase() + input.slice(1);
        ;
    }
});
app.filter('briefGroup', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        var obj = {};
        angular.forEach(data, function (v) {
            obj[v.group] = v;
        });
        return obj;
    }
});
app.filter('briefCategory', function () {
    return function (data) {
        if (typeof data == 'undefined') {
            return false;
        }

        var obj = {};
        angular.forEach(data, function (v) {
            obj[v.category_name] = v;
        });
        return obj;
    }
});
app.filter('briefQuestion', function () {
    return function (data,category_name) {
        if (typeof data == 'undefined') {
            return false;
        }
        if (typeof category_name == 'undefined') {
            return false;
        }

        var obj = [];
        angular.forEach(data, function (v) {
            if(category_name == v.category_name){
                
            obj.push(v);
            }
        });
        return obj;
    }
});
app.filter('limitChars', function () {
    return function (input, limit) {
        if (typeof input == 'undefined') {
            return false;
        }

        if(input.length > limit){
            
            return input.substring(0, limit) + '...';
        } else {
            
            return input;
        }
            
        return limit;
    }
});