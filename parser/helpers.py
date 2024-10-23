def do_int_from_coast_str(lst):
    coast = 0
    if lst == 0 or not lst:
        return coast
    if int(lst[len(lst) - 1]) > 0 and len(lst) == 3:
        coast = int(lst[0] + str((int(lst[1]) + 1)))
    elif int(lst[len(lst) - 1]) <= 0 and len(lst) == 3:
        coast = int(lst[0] + lst[1])
    elif int(lst[len(lst) - 1]) > 0 and len(lst) == 2:
        coast = int(lst[0]) + 1
    elif int(lst[len(lst) - 1]) <= 0 and len(lst) == 2:
        coast = int(lst[0])
    return coast


def do_raise_to_debag(DEBUG):
    if DEBUG:
        raise


def clear_str(str):
    return str.split('•')[1].strip()

