import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useState, useEffect } from "react";
const Create = ({ auth, subjects, teacher_id }: PageProps) => {
    const { data, setData, errors, post } = useForm({
        subject_id: [],
    });

    const [subject_id, setSubjectId] = useState([] as any);

    function handleSubmit(e: any) {
        e.preventDefault();
        post(
            route("teaches.store", {
                teacher: teacher_id,
            })
        );
    }

    useEffect(() => {
        setData("subject_id", subject_id);
    }, [subject_id]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Tambah Guru
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h3 className="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                Kelola Mengajar
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400 mb-5">
                                Pilih mata pelajaran yang diajar oleh guru ini.
                            </p>
                            <form onSubmit={handleSubmit}>
                                <table className="w-full">
                                    <thead>
                                        <tr>
                                            <th className="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                                Nama Mata Pelajaran
                                            </th>
                                            <th className="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {subjects.map((subject: any) => (
                                            <tr key={subject.id}>
                                                <td className="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                                    <div className="flex items-center">
                                                        <div>
                                                            <div className="text-sm leading-5 font-medium text-gray-900">
                                                                {subject.name}
                                                            </div>
                                                            <div className="text-sm leading-5 text-gray-500">
                                                                {subject.code}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                                    <div className="flex items-center">
                                                        <div>
                                                            <input
                                                                type="checkbox"
                                                                name="subject_id"
                                                                // jika subject_ishave sekarang maka checked

                                                                value={
                                                                    subject.id
                                                                }
                                                                onChange={(
                                                                    e
                                                                ) => {
                                                                    if (
                                                                        e.target
                                                                            .checked
                                                                    ) {
                                                                        setSubjectId(
                                                                            [
                                                                                ...subject_id,
                                                                                subject.id,
                                                                            ]
                                                                        );
                                                                    }
                                                                    if (
                                                                        !e
                                                                            .target
                                                                            .checked
                                                                    ) {
                                                                        setSubjectId(
                                                                            subject_id.filter(
                                                                                (
                                                                                    id: any
                                                                                ) =>
                                                                                    id !==
                                                                                    subject.id
                                                                            )
                                                                        );
                                                                    }
                                                                }}
                                                            />
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                                <button
                                    type="submit"
                                    className="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                >
                                    Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
